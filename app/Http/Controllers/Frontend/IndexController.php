<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserProfileRequest;
use App\Http\Resources\BlogResource;
use App\Http\Resources\Frontend\PackageListResource;
use App\Models\Blog;
use App\Models\Contact;
use App\Models\Destination;
use App\Models\Package;
use App\Models\Setting;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class IndexController extends Controller
{
    public function index()
    {
        $todayDate = Carbon::now()->format('Y-m-d');
        $packages = PackageListResource::collection(Package::where('status',1)->where('validity','>=',$todayDate)->latest()->latest('id')->limit(3)->get());
        $blogs = BlogResource::collection(Blog::where('status',1)->latest()->latest('id')->limit(3)->get());
        $destinations = Destination::where('status',1)->latest()->latest('id')->limit(3)->get();
        return Inertia::render('Index',[
            'packages' => $packages,
            'blogs' => $blogs,
            'destinations' => $destinations,
        ]);
    }

    public function about()
    {
        return Inertia::render('About');
    }

    public function blogs()
    {
        $blogs = BlogResource::collection(Blog::where('status',1)->latest()->latest('id')->limit(3)->get());
        return Inertia::render('Service',[
            'blogs' => $blogs,
        ]);
    }

    public function package(Request $request)
    {
        $todayDate = Carbon::now()->format('Y-m-d');

        // Get query parameters
        $destination = $request->query('destination');
        $startDate = $request->query('start_date');
        $returnDate = $request->query('return_date');

        $query = Package::where('status', 1)
            ->where('validity', '>=', $todayDate);

        // Apply filtering based on destination
        if ($destination) {
            $query->where('country', $destination);
        }

        // Apply date range filter if provided
        if (!empty($startDate)) {
            $query->where('validity', '>=', $startDate);
        }
        if (!empty($returnDate)) {
            $query->where('validity', '>=', $returnDate);
        }

        $packages = PackageListResource::collection($query->latest()->latest('id')->limit(9)->get());

        return Inertia::render('Package', [
            'packages' => $packages
        ]);
    }

    public function contact()
    {
        return Inertia::render('Contact');
    }

    public function userProfileEdit()
    {
        $user = Auth::user();
        return Inertia::render('ProfileEdit',[
            'user' => $user
        ]);
    }

    public function userProfileUpdate(UserProfileRequest $request)
    {
        if ($request->hasFile('profile_photo_path')) {
            $file = $request->file('profile_photo_path');
            $fileName = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            $file->move(public_path('upload/user'), $fileName);
            $image = 'upload/user/' . $fileName;
        }

        User::where('id',Auth::user()->id)->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'profile_photo_path' => $image ?? Auth::user()->profile_photo_path,
        ]);
        return redirect()->route('dashboard');
    }

    public function userPasswordEdit()
    {
        return Inertia::render('PasswordEdit');
    }

    public function userPasswordUpdate(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:8',
        ]);

        User::where('id',Auth::user()->id)->update([
            'password' => Hash::make($request->password),
        ]);
        return redirect()->route('dashboard');
    }

    public function fetchDestinations()
    {
        $destinations = Destination::where('status',1)->latest()->latest('id')->limit(3)->get();

        return response()->json($destinations);
    }

    public function searchTour(Request $request)
    {
        $destination = $request->input('destination');
        $startDate = $request->input('start_date');
        $returnDate = $request->input('return_date');

        // Ensure $startDate and $returnDate are in the correct format
        $todayDate = Carbon::now()->format('Y-m-d');

        $query = Package::where('status', 1)
            ->where('validity', '>=', $todayDate);

        // Apply destination filter if provided
        if (!empty($destination)) {
            $query->where('country', $destination);
        }

        // Apply date range filter if provided
        if (!empty($startDate)) {
            $query->where('validity', '>=', $startDate);
        }
        if (!empty($returnDate)) {
            $query->where('validity', '>=', $returnDate);
        }

        $packages = $query->latest()->latest('id')->limit(9)->get();
        $packages = PackageListResource::collection($packages);

        return Inertia::render('Package', [
            'packages' => $packages,
        ]);
    }

    public function blogSingle($blog)
    {
        $blog = Blog::where('id',$blog)->first();

        $blog = new BlogResource($blog);
        return Inertia::render('SingleBlog',[
           'blog' => $blog
        ]);
    }

    public function contactStore(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        Contact::create($validatedData);
        return redirect()->back()->with('success', 'Your message has been sent successfully!');
    }
}

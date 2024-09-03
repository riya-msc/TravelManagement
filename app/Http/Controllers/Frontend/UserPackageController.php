<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\PackageBookingRequest;
use App\Http\Requests\TourQueryRequest;
use App\Http\Resources\Frontend\BookedPackageResource;
use App\Models\Package;
use App\Models\PackageBooking;
use App\Models\TourQuery;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class UserPackageController extends Controller
{
    public function packageShow($packageCode)
    {
        $package = Package::where('package_code',$packageCode)->first();
        $validity = Carbon::parse($package->validity)->format('d M,Y');
        $packageImages = json_decode($package->package_images);
        $packageItinerary = json_decode($package->package_itinerary);
        $packageInqExq = json_decode($package->package_inq_exc);

        $packageInq = $packageInqExq->inclusion;
        $packageEnq = $packageInqExq->exclusion;

        return Inertia::render('Package/SinglePackage',[
            'package' => $package,
            'validity' => $validity,
            'packageImages' => $packageImages,
            'packageItinerary' => $packageItinerary,
            'packageInq' => $packageInq,
            'packageEnq' => $packageEnq,
        ]);
    }

    public function packageBooking($packageCode)
    {
        $package = Package::where('package_code',$packageCode)->first();
        return Inertia::render('Package/PackageBooking',[
            'package' => $package,
        ]);
    }

    public function packageBookingStore(PackageBookingRequest $request)
    {
        $packageBooking = new PackageBooking();
        $packageBooking->user_id = Auth::user()->id;
        $packageBooking->package_id = $request->package_id;
        $packageBooking->traveller_email = $request->traveller_email;
        $packageBooking->traveller_phone = $request->traveller_phone;
        $packageBooking->number_of_adult = $request->number_of_adult;
        $packageBooking->number_of_child = $request->number_of_child;
        $packageBooking->journey_date = Carbon::parse($request->journey_date)->format('Y-m-d');
        $packageBooking->total_amount = $request->total_amount;
        $packageBooking->due_amount = $request->total_amount;
        $packageBooking->other_requirements = $request->other_requirements ?? '';

        // Handle file uploads for adult_infos
        $adultInfos = [];
        foreach ($request->adult_infos as $index => $adultInfo) {
            if (isset($adultInfo['passportCopy']) && $request->hasFile('adult_infos.' . $index . '.passportCopy')) {
                $file = $request->file('adult_infos.' . $index . '.passportCopy');
                $fileName = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
                $file->move(public_path('upload/package/passport_copy'), $fileName);
                $adultInfo['passportCopy'] = 'upload/package/passport_copy/' . $fileName;
            } else {
                $adultInfo['passportCopy'] = null;
            }
            $adultInfos[] = $adultInfo;
        }

        // Handle file uploads for child_infos
        $childInfos = [];
        if (isset($request->child_infos)) {
            foreach ($request->child_infos as $index => $childInfo) {
                if (isset($childInfo['passportCopy']) && $request->hasFile('child_infos.' . $index . '.passportCopy')) {
                    $file = $request->file('child_infos.' . $index . '.passportCopy');
                    $fileName = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
                    $file->move(public_path('upload/package/passport_copy'), $fileName);
                    $childInfo['passportCopy'] = 'upload/package/passport_copy/' . $fileName;
                } else {
                    $childInfo['passportCopy'] = null;
                }
                $childInfos[] = $childInfo;
            }
        }

        // Save adult_infos and child_infos as JSON
        $packageBooking->adult_infos = json_encode($adultInfos);
        $packageBooking->child_infos = json_encode($childInfos);

        // Save the package booking
        $packageBooking->save();

        // Redirect or return a response
        return redirect()->back();
    }

    public function bookedPackages()
    {
        $bookedPackages = PackageBooking::with('package')->where('user_id',Auth::user()->id)->orderBy('id','DESC')->get();
        return Inertia::render('Package/BookedPackages',[
            'bookedPackages' => $bookedPackages,
        ]);
    }

    public function viewBookedPackages($packageBooking)
    {
        $bookedPackage = PackageBooking::with('package')->where('id',$packageBooking)->first();
        $bookedPackage = new BookedPackageResource($bookedPackage);
        return Inertia::render('Package/ViewBookedPackage',[
            'bookedPackage' => $bookedPackage,
        ]);
    }

    public function storeTourQuery(TourQueryRequest $request)
    {
        TourQuery::create($request->all());
        return redirect()->back();
    }
}

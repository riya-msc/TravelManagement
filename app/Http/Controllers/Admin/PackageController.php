<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PackageRequest;
use App\Models\Destination;
use App\Models\Package;
use App\Models\PackageBooking;
use App\Models\TourQuery;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function createPackage()
    {
        $destinations = Destination::where('status',1)->get();
        return view('admin.package.create_package',compact('destinations'));
    }

    public function storePackage(PackageRequest $request)
    {
        $parsedDate = Carbon::createFromFormat('d M, Y', $request->validity);
        $formattedDateValidity = $parsedDate->format('Y-m-d');

        $currentDate = Carbon::today();
        $concatenatedDate = $currentDate->format('Ymd');

        $lastPackage = Package::orderBy('id', 'DESC')->first();
        $packageLastId = $lastPackage ? $lastPackage->id + 1 : 1;

        $data = array();

        if ($request->hasFile('package_banner')) {
            $file = $request->file('package_banner');
            $fileName = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            $file->move(public_path('upload/package'), $fileName);
            $data['package_banner'] = 'upload/package/' . $fileName;
        }

        if ($request->hasFile('package_images')){
            $images = $request->file('package_images');
            $dataImg = array();

            $sl = 1;
            foreach ($images as $img){
                $fileName = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
                $img->move(public_path('upload/package'), $fileName);
                $dataImg[] = [
                    'id' => $sl++,
                    'image' => 'upload/package/' . $fileName,
                ];
            }

            $data['package_images'] = json_encode($dataImg);
        }

        $packageInqExc = [
            'inclusion' => $request->inclusion,
            'exclusion' => $request->exclusion
        ];

        $data['package_code'] = 'PKG-1' . $concatenatedDate . $packageLastId;
        $data['package_name'] = $request->package_name;
        $data['country'] = $request->country;
        $data['city'] = $request->city;
        $data['package_duration'] = $request->package_duration;
        $data['package_price'] = $request->package_price;
        $data['package_rating'] = $request->package_rating;
        $data['package_person'] = $request->package_person;
        $data['validity'] = $formattedDateValidity;
        $data['package_inq_exc'] = json_encode($packageInqExc);
        $data['terms_condition'] = $request->terms_condition;
        $data['status'] = 1;

        Package::create($data);

        $notification = array(
            'message' => 'Package Created Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('list.package')->with($notification);
    }

    public function listPackage()
    {
        $packages = Package::latest()->get();
        return view('admin.package.package_list',compact('packages'));
    }

    public function itineraryPackage(Package $package)
    {
        $packageItinerary = json_decode($package->value('package_itinerary'));
        return view('admin.package.package_itinerary',compact('package','packageItinerary'));
    }

    public function manageItineraryPackage(Package $package)
    {
        $packageItinerary = json_decode($package->value('package_itinerary'));
        return view('admin.package.package_itinerary_manage',compact('package','packageItinerary'));
    }

    public function storePackageItinerary(Request $request, $packageId)
    {
        $rules = [
            'tour_title.*' => 'required|string|max:255',
            'tour_description.*' => 'required|string',
            'tour_image.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ];

        $messages = [
            'tour_title.*.required' => 'The tour title for each day is required.',
            'tour_description.*.required' => 'The tour description for each day is required.',
            'tour_image.*.image' => 'The tour image must be an image file.',
            'tour_image.*.mimes' => 'The tour image must be a file of type: jpg, jpeg, png.',
            'tour_image.*.max' => 'The tour image must not be greater than 2MB.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $package = Package::findOrFail($packageId);
        $existingItinerary = json_decode($package->package_itinerary, true);

        $data = $request->all();
        $itinerary = [];


        foreach ($data['tour_title'] as $index => $title) {
            $description = $data['tour_description'][$index];
            $imagePath = $existingItinerary[$index]['tour_image'] ?? null;

            if ($request->hasFile('tour_image.' . $index)) {
                $file = $request->file('tour_image.' . $index);
                $fileName = hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('upload/package'), $fileName);
                $imagePath = 'upload/package/' . $fileName;
            }

            $itinerary[] = [
                'id' => $index + 1,
                'tour_title' => $title,
                'tour_description' => $description,
                'tour_image' => $imagePath,
            ];
        }

        $itineraryJson = json_encode($itinerary, JSON_UNESCAPED_SLASHES);

        $package->package_itinerary = $itineraryJson;
        $package->save();


        $notification = array(
            'message' => 'Package Itinerary Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('list.package')->with($notification);
    }

    public function editPackage(Package $package)
    {
        $destinations = Destination::where('status',1)->get();
        return view('admin.package.package_edit',compact('package','destinations'));
    }

    public function removeImage(Package $package,$image)
    {
        $packageImages = json_decode($package->package_images, true);

        $filteredImages = array_filter($packageImages, function($img) use ($image) {
            return $img['id'] != $image;
        });

        $reindexedImages = array_values($filteredImages);

        foreach ($reindexedImages as $index => &$img) {
            $img['id'] = $index + 1;
        }

        $package->package_images = json_encode($reindexedImages);
        $package->save();
        return redirect()->back()->with('success', 'Image removed successfully.');
    }

    public function updatePackage(PackageRequest $request,Package $package)
    {
        $parsedDate = Carbon::createFromFormat('d M, Y', $request->validity);
        $formattedDateValidity = $parsedDate->format('Y-m-d');

        $currentDate = Carbon::today();
        $concatenatedDate = $currentDate->format('Ymd');

        $lastPackage = Package::orderBy('id', 'DESC')->first();
        $packageLastId = $lastPackage ? $lastPackage->id + 1 : 1;

        $data = array();

        if ($request->hasFile('package_banner')) {
            $file = $request->file('package_banner');
            $fileName = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            $file->move(public_path('upload/package'), $fileName);
            $data['package_banner'] = 'upload/package/' . $fileName;
        }

        if ($request->hasFile('package_images')) {
            $images = $request->file('package_images');
            $dataImg = array();

            $existingImages = json_decode($package->package_images, true) ?? [];

            $nextId = count($existingImages) + 1;

            foreach ($images as $img) {
                $fileName = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
                $img->move(public_path('upload/package'), $fileName);
                $dataImg[] = [
                    'id' => $nextId++,
                    'image' => 'upload/package/' . $fileName,
                ];
            }

            $mergedImages = array_merge($existingImages, $dataImg);

            $data['package_images'] = json_encode($mergedImages);
        }

        $packageInqExc = [
            'inclusion' => $request->inclusion,
            'exclusion' => $request->exclusion
        ];

        $data['package_code'] = 'PKG-1' . $concatenatedDate . $packageLastId;
        $data['package_name'] = $request->package_name;
        $data['country'] = $request->country;
        $data['city'] = $request->city;
        $data['package_duration'] = $request->package_duration;
        $data['package_price'] = $request->package_price;
        $data['package_rating'] = $request->package_rating;
        $data['package_person'] = $request->package_person;
        $data['validity'] = $formattedDateValidity;
        $data['package_inq_exc'] = json_encode($packageInqExc);
        $data['terms_condition'] = $request->terms_condition;
        $data['status'] = 1;

        $package->update($data);

        $notification = array(
            'message' => 'Package Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('list.package')->with($notification);
    }

    public function deactivatePackage(Package $package)
    {
        $package->update([
            'status' => 0
        ]);

        $notification = array(
            'message' => 'Package Deactivated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function activatePackage(Package $package)
    {
        $package->update([
            'status' => 1
        ]);

        $notification = array(
            'message' => 'Package Activated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function manageVisaPackage(Package $package)
    {
        return view('admin.package.package_visa_requirements',compact('package'));
    }

    public function visaRequirementsStore(Request $request, Package $package)
    {
        $package->update([
            'visa_requirements' => $request->visa_requirements
        ]);

        $notification = array(
            'message' => 'Visa Requirements Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('list.package')->with($notification);
    }

    public function bookedPackage()
    {
        $bookedPackages = PackageBooking::with(['package','user'])->get();

        return view('admin.package.booked_package',compact('bookedPackages'));
    }

    public function bookedPackageDetails(PackageBooking $packageBooking)
    {

        $adultInfo = json_decode($packageBooking['adult_infos']);
        $childInfo = json_decode($packageBooking['child_infos']);

        $packageBooking['adult_infos'] = $adultInfo;
        $packageBooking['child_infos'] = $childInfo;

        return view('admin.package.booked_package_details',compact('packageBooking'));
    }

    public function bookedPackageModify(PackageBooking $packageBooking)
    {
        return view('admin.package.booked_package_modify',compact('packageBooking'));
    }

    public function bookedPackageUpdate(Request $request, PackageBooking $packageBooking)
    {
        $validator = Validator::make($request->all(), [
            'paid_amount' => 'required|numeric|min:0',
            'due_payment_date' => 'required',
        ]);

        if (!$packageBooking->advanced_amount) {
            if ($packageBooking->total_amount < $request->advanced_amount){
                $validator->after(function ($validator) {
                    $validator->errors()->add('paid_amount', 'The advanced amount cannot be greater than the total amount.');
                });
            }
        }

        if ($packageBooking->advanced_amount) {
            if ($packageBooking->total_amount < $packageBooking->paid_amount + $request->paid_amount){
                $validator->after(function ($validator) {
                    $validator->errors()->add('paid_amount', 'The amount cannot be greater than the total amount.');
                });
            }
        }

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $packageBooking->update([
           'advanced_amount' => $packageBooking->advanced_amount ? $packageBooking->advanced_amount : $request->paid_amount,
           'paid_amount' => $packageBooking->paid_amount + $request->paid_amount,
           'payment_status' => $packageBooking->total_amount == ($packageBooking->paid_amount + $request->paid_amount) ? 1 : $request->payment_status,
           'booking_status' => $packageBooking->total_amount == ($packageBooking->paid_amount + $request->paid_amount) ? 1 : $request->booking_status,
           'due_payment_date' => $request->due_payment_date,
           'due_amount' => $packageBooking->total_amount - ($packageBooking->paid_amount + $request->paid_amount),
        ]);

        $notification = array(
            'message' => 'Booked Package Modified Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('booked.package.details',$packageBooking->id)->with($notification);
    }

    public function tourQueries()
    {
        $tourQueries = TourQuery::orderBy('id','DESC')->get();
        return view('admin.package.tour_queries',compact('tourQueries'));
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\GlobalHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\AboutRequest;
use App\Http\Requests\Admin\Setting\InformationRequest;
use App\Models\Contact;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function information()
    {
        $information = json_decode(Setting::first()->company_information);

        return view('admin.setting.information.index',compact('information'));
    }

    public function about()
    {
        $about = json_decode(Setting::first()->company_about);

        return view('admin.setting.information.about',compact('about'));
    }

    public function storeInformation(InformationRequest $request)
    {
        $information = json_decode(Setting::first()->company_information, true);

        $data = [];

        $data['name'] = trim($request->name) === '' ? $information['name'] : $request->name;
        $data['contact'] = trim($request->contact) === '' ? $information['contact'] : $request->contact;
        $data['email'] = trim($request->email) === '' ? $information['email'] : $request->email;
        $data['address'] = trim($request->address) === '' ? $information['address'] : $request->address;

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            if (!empty($information['logo'])) {
                @unlink(public_path($information['logo']));
            }
            $fileName = 'logo-main.' .$file->getClientOriginalExtension();
            $file->move(public_path('upload'), $fileName);
            $data['logo'] = 'upload/' . $fileName;
        } else {
            $data['logo'] = $information['logo'];
        }

        $companyInformation = json_encode($data);

        Setting::where('id', 1)->update(['company_information' => $companyInformation]);

        $notification = array(
            'message' => 'Company Information Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function aboutUpdate(AboutRequest $request)
    {
        $about = json_decode(Setting::first()->company_about, true);

        $data = [];

        $data['title'] = trim($request->title) === '' ? $about['title'] : $request->title;
        $data['body'] = trim($request->body) === '' ? $about['body'] : $request->body;

        if ($request->hasFile('main_image')) {
            $file = $request->file('main_image');
            if (!empty($about['main_image'])) {
                @unlink(public_path($about['main_image']));
            }
            $fileName = rand(1000,10000) .$file->getClientOriginalExtension();
            $file->move(public_path('upload/about'), $fileName);
            $data['main_image'] = 'upload/about/' . $fileName;
        } else {
            $data['main_image'] = $about['main_image'];
        }

        if ($request->hasFile('image1')) {
            $file = $request->file('image1');
            if (!empty($about['image1'])) {
                @unlink(public_path($about['image1']));
            }
            $fileName = rand(1000,10000) .$file->getClientOriginalExtension();
            $file->move(public_path('upload/about'), $fileName);
            $data['image1'] = 'upload/about/' . $fileName;
        } else {
            $data['image1'] = $about['image1'];
        }

        if ($request->hasFile('image2')) {
            $file = $request->file('image2');
            if (!empty($about['image2'])) {
                @unlink(public_path($about['image2']));
            }
            $fileName = rand(1000,10000) .$file->getClientOriginalExtension();
            $file->move(public_path('upload/about'), $fileName);
            $data['image2'] = 'upload/about/' . $fileName;
        } else {
            $data['image2'] = $about['image2'];
        }

        $companyAbout = json_encode($data);

        Setting::where('id', 1)->update(['company_about' => $companyAbout]);

        $notification = array(
            'message' => 'Company About Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function services()
    {
        $services = GlobalHelper::getServices();
        return view('admin.setting.services.index',compact('services'));
    }

    public function serviceUpdate(Request $request,$id)
    {
        $services = GlobalHelper::getServices();

        $service = null;
        foreach ($services as $index => $item) {
            if ($item->id == $id) {
                $service = $index;
                break;
            }
        }

        if ($service !== null) {
            $services[$service]->service_title = $request->input('service_title', $services[$service]->service_title);
            $services[$service]->service_icon = $request->input('service_icon', $services[$service]->service_icon);
            $services[$service]->service_text = $request->input('service_text', $services[$service]->service_text);

            Setting::where('id', 1)->update(['company_services' => json_encode($services)]);

            $notification = array(
                'message' => 'Company Service Updated Successfully',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);

        } else {
            return response()->json(['error' => 'Service not found'], 404);
        }
    }

    public function contacts()
    {
        Contact::query()->update(['read_message' => 1]);
        $contacts = Contact::orderBy('id', 'DESC')->get();

        return view('admin.setting.contacts', compact('contacts'));
    }
}

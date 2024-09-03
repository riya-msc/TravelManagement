<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DestinationController extends Controller
{
    public function destinations()
    {
        $destinations = Destination::latest('id')->get();
        return view('admin.destination.index',compact('destinations'));
    }
    public function destinationAdd()
    {
        return view('admin.destination.add');
    }

    public function destinationStore(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:destinations'
            ],
            'number_of_cities' => 'required',
            'thumb' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('thumb')) {
            $file = $request->file('thumb');
            $fileName = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            $file->move(public_path('upload/destination'), $fileName);
            $image = 'upload/destination/' . $fileName;
        }

        Destination::create([
            'name' => $request->name,
            'number_of_cities' => $request->number_of_cities,
            'thumb' => $image,
        ]);

        $notification = array(
            'message' => 'Destination Added Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.destinations')->with($notification);
    }

    public function destinationEdit(Destination $destination)
    {
        return view('admin.destination.edit',compact('destination'));
    }

    public function destinationUpdate(Request $request,Destination $destination)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                Rule::unique('destinations')->ignore($destination->id),
            ],
            'number_of_cities' => 'required',
            'thumb' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('thumb')) {
            $file = $request->file('thumb');
            $fileName = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            $file->move(public_path('upload/destination'), $fileName);
            $image = 'upload/destination/' . $fileName;
        }

        $destination->update([
            'name' => $request->name,
            'number_of_cities' => $request->number_of_cities,
            'thumb' => $image ?? $destination->thumb,
        ]);

        $notification = array(
            'message' => 'Destination Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.destinations')->with($notification);
    }
    public function destinationDeactivate(Destination $destination)
    {
        $destination->update([
            'status' => 0
        ]);
        $notification = array(
            'message' => 'Destination Deactivated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.destinations')->with($notification);
    }
    public function destinationActivate(Destination $destination)
    {
        $destination->update([
            'status' => 1
        ]);
        $notification = array(
            'message' => 'Destination Activated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.destinations')->with($notification);
    }
}

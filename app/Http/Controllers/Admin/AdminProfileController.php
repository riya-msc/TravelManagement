<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminProfileController extends Controller
{
    public function profile()
    {
        $admin = Admin::where('id',auth()->guard('admin')->user()->id)->first();
        return view('auth.admin_profile',compact('admin'));
    }

    public function changePassword()
    {
        return view('auth.admin_password_change');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:8',
        ]);

        Admin::where('id',auth()->guard('admin'))->update([
            'password' => Hash::make($request->password)
        ]);
        $notification = array(
            'message' => 'Password Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.profile')->with($notification);

    }
}

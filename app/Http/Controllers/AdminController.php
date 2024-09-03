<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Contact;
use App\Models\PackageBooking;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Inertia\Inertia;

class AdminController extends Controller
{
    // Show the auth login form
    public function loginForm()
    {
        if (auth()->guard('admin')->user()) {
            return redirect()->route('admin.dashboard');
        }

        return view('auth.adminLogin');
    }

    // Handle auth login
    public function adminLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');

        $admin = Admin::where('email', $credentials['email'])->first();

        if (!$admin || !Hash::check($credentials['password'], $admin->password)) {
            return redirect()->route('admin.loginForm')->withErrors(['email' => 'These credentials do not match our records.'])->withInput();
        }

        if ($remember) {
            $admin->setRememberToken(Str::random(60));
            $admin->save();
        }

        Auth::guard('admin')->login($admin, $remember);

        return to_route('admin.dashboard');
    }

    public function dashboard()
    {
        $users = count(User::get());
        $packageBooking = count(PackageBooking::where('booking_status',0)->get());
        $newContactMessage = count(Contact::where('read_message',0)->get());
        return view('admin.dashboard',compact('users','packageBooking','newContactMessage'));
    }

    // Handle auth logout
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        if ($request->user('admin')) {
            $request->user('admin')->setRememberToken(null);
            $request->user('admin')->save();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return to_route('index');
    }
}

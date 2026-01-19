<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class SettingsController extends Controller
{
    // Main Settings overview page
    public function index()
    {
        return view('admin.settings.index');
    }

    // Profile settings page
    public function profile()
    {
        $user = Auth::user(); // get logged-in admin/user
        return view('admin.settings.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'phone' => 'nullable|string|max:15',
        ]);

        $user->update($request->only('name','email','phone'));

        return redirect()->back()->with('success','Profile updated successfully!');
    }

    // Security page
    public function security()
    {
        return view('admin.settings.security');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        $user = Auth::user();

        if(!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password'=>'Current password is incorrect']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->back()->with('success','Password updated successfully!');
    }

    // Notifications page
    public function notifications()
    {
        return view('admin.settings.notifications');
    }

    // Preferences page
    public function preferences()
    {
        return view('admin.settings.preferences');
    }
}

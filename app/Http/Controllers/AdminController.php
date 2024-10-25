<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AdminController extends Controller
{
    public function AdminDashboard(): View
    {
        return view('admin.index');
    }

    public function AdminLogout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }

    public function AdminLogin(): View
    {
        return view('admin.admin_login');
    }

    public function AdminProfile(): View
    {
        $id = Auth::user()->id;
        $user = User::query()->find($id);
        return view('admin.admin_profile', compact('user'));
    }

    public function AdminProfileStore(Request $request): RedirectResponse
    {
        $id = Auth::user()->id;
        $user = User::query()->find($id);
        $user->name = $request->input('name');
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->address = $request->input('address');

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('upload/admin_images/' . $user->photo));
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'), $filename);
            $user->photo = $filename;
        }

        $user->save();

        $notification = [
            'message' => "Success update profile",
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }

    public function AdminChangePassword(): View
    {
        $id = Auth::user()->id;
        $user = User::query()->find($id);
        return view('admin.admin_change_password', compact('user'));
    }

    public function AdminChangePasswordStore(Request $request): RedirectResponse
    {
        // Validation
        $request->validate([
            'old_password' => ['required', 'string', 'min:6'],
            'new_password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        if (!Hash::check($request->input('old_password'), Auth::user()->password)) {
            $notification = [
                "message" => "Password doesn't match",
                "alert-type" => "error"
            ];
            return back()->with($notification);
        }

        // Update new Password
        User::whereId(Auth::user()->id)->update([
            "password" => Hash::make($request->input('new_password'))
        ]);

        $notification = [
            "message" => "Success Update Password",
            "alert-type" => "success"
        ];
        return back()->with($notification);
    }
}

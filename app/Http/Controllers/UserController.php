<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(): View
    {
        return view('frontend.index');
    }

    public function profile(): View
    {
        $user = Auth::user();
        return view('frontend.dashboard.edit_profile', compact('user'));
    }

    public function updateProfile(Request $request): RedirectResponse
    {
        $id = Auth::user()->id;
        $user = User::query()->find($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->username = $request->input('username');
        $user->phone = $request->input('phone');
        $user->address = $request->input('address');

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('upload/user_images/' . $user->photo));
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/user_images'), $filename);
            $user->photo = $filename;
        }

        $user->save();

        $notification = [
            "message" => "Profile updated successfully",
            "alert-type" => "success"
        ];

        return redirect()->back()->with($notification);
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/home');
    }

    public function change_password(): View
    {
        $user = Auth::user();
        return view('frontend.dashboard.change_password', compact('user'));
    }

    public function change_password_store(Request $request): RedirectResponse
    {
        $request->validate([
            'old_password' => ['required', 'string', 'min:6'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
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
            "password" => Hash::make($request->input('password'))
        ]);

        $notification = [
            "message" => "Success Update Password",
            "alert-type" => "success"
        ];
        return back()->with($notification);
    }
}

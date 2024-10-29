<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class InstructorController extends Controller
{
    public function InstructorDashboard(): View
    {
        return view('instructor.index');
    }

    public function InstructorLogout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/instructor/login');
    }

    public function InstructorRegister(): View
    {
        return view('frontend.instructor.register');
    }

    public function InstructorStore(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'address' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:6'],
        ]);

        User::query()->insert([
            "name" => $request->input("name"),
            "username" => $request->input("username"),
            "email" => $request->input("email"),
            "address" => $request->input("address"),
            "phone" => $request->input("phone"),
            "password" => Hash::make($request->input("password")),
            "role" => "instructor",
            "status" => "0"
        ]);

        $notification = [
            "message" => "Instructor Registered Successfully",
            "alert-type" => "success"
        ];

        return redirect()->route('instructor.login')->with($notification);
    }

    public function InstructorLogin(): View
    {
        return view('instructor.instructor_login');
    }

    public function InstructorProfile(): View
    {
        $id = Auth::user()->id;
        $user = User::query()->find($id);
        return view('instructor.instructor_profile', compact('user'));
    }

    public function InstructorProfileStore(Request $request): RedirectResponse
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
            @unlink(public_path('upload/instructor_images/' . $user->photo));
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/instructor_images'), $filename);
            $user->photo = $filename;
        }

        $user->save();

        $notification = [
            'message' => "Success update profile",
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }

    public function InstructorChangePassword(): View
    {
        $id = Auth::user()->id;
        $user = User::query()->find($id);
        return view('instructor.instructor_change_password', compact('user'));
    }

    public function InstructorChangePasswordStore(Request $request): RedirectResponse
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

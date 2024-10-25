<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('frontend.dashboard.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        try {
            $request->authenticate();

            $request->session()->regenerate();

            $url = '';

            if ($request->user()->role == "admin") {
                $url = 'admin/dashboard';
            } elseif ($request->user()->role == "instructor") {
                $url = 'instructor/dashboard';
            } elseif ($request->user()->role == "user") {
                $url = '/dashboard';
            }

            return redirect()->intended($url);
        } catch (ValidationException $validationException) {
            $notification = [
                "message" => "Email or Password doesn't match",
                "alert-type" => "error"
            ];
            return back()->with($notification);
        }

    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/home');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    /**
     * Handle Login Request
     */
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Redirect to intended page if 'redirect' exists, else fallback to home or account page
            $redirectTo = $request->input('redirect', url('/'));
            return redirect()->to($redirectTo);
        }

        return back()->withErrors([
            'email' => 'Invalid credentials. Please try again.',
        ])->onlyInput('email');
    }

    /**
     * Handle Register Request
     */
    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed'
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        // After registration, redirect to intended page if exists, else home
        $redirectTo = $request->input('redirect', url('/'));
        return redirect()->to($redirectTo);
    }

    /**
     * Logout User
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    /**
     * Redirect to Google for Authentication
     */
    public function redirectToGoogle(Request $request)
    {
        // Capture the intended URL, default to home
        $redirectTo = $request->input('redirect', url('/'));
        session(['google_redirect' => $redirectTo]);

        return Socialite::driver('google')->redirect();
    }

    /**
     * Handle Google Callback
     */
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();

            $user = User::firstOrCreate(
                ['email' => $googleUser->getEmail()],
                [
                    'name'     => $googleUser->getName(),
                    'password' => Hash::make(uniqid()), // random password
                ]
            );

            Auth::login($user);

            // Redirect to intended page after Google login
            $redirectTo = session()->pull('google_redirect', url('/'));
            return redirect()->to($redirectTo);

        } catch (\Exception $e) {
            return redirect('/')->withErrors(['msg' => 'Google login failed.']);
        }
    }
}

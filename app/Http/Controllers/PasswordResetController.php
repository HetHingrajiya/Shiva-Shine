<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class PasswordResetController extends Controller
{
    // Show forgot password form
    public function showLinkRequestForm()
    {
        return view('auth.forgot-password');
    }

    // Send reset link email
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink($request->only('email'));

        if ($request->ajax() || $request->wantsJson()) {
            if ($status === Password::RESET_LINK_SENT) {
                return response()->json([
                    'status'  => __($status),
                    'message' => 'Reset password email sent successfully!'
                ]);
            } else {
                return response()->json([
                    'errors' => ['email' => [__($status)]]
                ], 422);
            }
        }

        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()->withErrors(['email' => __($status)]);
    }

    // Show reset form
    public function showResetForm(Request $request, $token)
    {
        // Get email from query parameter if available
        $email = $request->email;
        return view('auth.reset-password', ['token' => $token, 'email' => $email]);
    }

    // Handle reset
    public function reset(Request $request)
    {
        $request->validate([
            'token'    => 'required',
            'email'    => 'required|email',
            'password' => 'required|min:6|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->save();

                // Send HTML email
                Mail::html('
                    <html>
                    <body style="font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px;">
                        <div style="max-width: 600px; margin: auto; background-color: #ffffff; padding: 30px; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                            <h2 style="color: #333;">Hello ' . $user->name . ',</h2>
                            <p style="color: #555; font-size: 16px;">
                                Your password has been <strong>successfully changed</strong>.
                            </p>
                            <p style="color: #555; font-size: 16px;">
                                If you did not perform this action, please contact our support immediately.
                            </p>
                            <a href="' . route('account.index') . '" style="display: inline-block; padding: 10px 20px; background-color: #4F46E5; color: #fff; text-decoration: none; border-radius: 5px; margin-top: 20px;">Go to My Account</a>
                            <p style="color: #aaa; font-size: 12px; margin-top: 20px;">&copy; ' . date('Y') . ' Shiva Shine. All rights reserved.</p>
                        </div>
                    </body>
                    </html>
                ', function ($message) use ($user) {
                    $message->to($user->email)
                            ->subject('Your Password Has Been Changed');
                });
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('account.index')->with('status', 'Your password has been changed successfully!')
            : back()->withErrors(['email' => [__($status)]]);
    }
}

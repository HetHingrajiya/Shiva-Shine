<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\TestMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class OtpController extends Controller
{
    /**
     * Send OTP via email
     */
    public function sendOtp(Request $request)
    {
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'You must be logged in to request OTP.'
            ], 401);
        }

        $user = Auth::user();
        $otp = rand(100000, 999999);

        // Save OTP to session with expiration
        session([
            'checkout_otp' => $otp,
            'otp_verified' => false,
            'otp_expires_at' => now()->addMinutes(5)
        ]);

        // Send OTP mail
        try {
            Mail::to($user->email)->send(new TestMail($otp));
        } catch (\Exception $e) {
            Log::error("Failed to send OTP email: " . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to send OTP email. Please try again.'
            ], 500);
        }

        // Log for debugging
        Log::info("Checkout OTP for {$user->email}: {$otp}", [
            'user_id' => $user->id,
            'time' => now()->toDateTimeString()
        ]);

        return response()->json([
            'success' => true,
            'message' => 'OTP sent to your email. Please check your inbox.'
        ]);
    }

    /**
     * Verify OTP
     */
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|numeric',
        ]);

        $sessionOtp = Session::get('checkout_otp');
        $expiresAt = Session::get('otp_expires_at');

        if (!$sessionOtp || !$expiresAt || now()->greaterThan($expiresAt)) {
            return response()->json([
                'success' => false,
                'message' => 'OTP expired. Please request a new one.'
            ]);
        }

        if ($request->otp == $sessionOtp) {
            Session::put('otp_verified', true);
            return response()->json([
                'success' => true,
                'message' => 'OTP Verified Successfully!'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Invalid OTP'
        ]);
    }
}

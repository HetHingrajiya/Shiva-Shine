@extends('layouts.app')

@section('content')
<section class="py-16 bg-gray-50 mt-20">
    <div class="max-w-lg mx-auto bg-white rounded-xl shadow-lg p-6">
        <h2 class="text-2xl font-bold text-center mb-6">🔑 Verify Your Order</h2>

        @if(session('error'))
            <p class="text-red-600 text-center mb-4">{{ session('error') }}</p>
        @endif

        <form method="POST" action="{{ route('checkout.verifyOtp', $order->order_code) }}" class="space-y-4">
            @csrf
            <label class="block text-sm font-medium mb-1">Enter OTP</label>
            <input type="text" name="otp" maxlength="6" class="w-full border rounded-lg p-3" required>

            <button type="submit" class="w-full bg-indigo-600 text-white py-3 rounded-lg font-semibold hover:bg-indigo-700">
                Confirm Order
            </button>
        </form>
    </div>
</section>
@endsection

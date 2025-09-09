@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<section class="bg-white shadow-md rounded-lg p-6 max-w-2xl mx-auto">
    <h1 class="text-2xl font-bold mb-6">🛒 Checkout</h1>

    <!-- Cart Items -->
    <div class="mb-6">
        <h2 class="text-xl font-semibold mb-3">Your Items</h2>
        <div class="divide-y divide-gray-200">
            @foreach($cartItems as $item)
                <div class="flex justify-between py-3">
                    <div class="flex items-center space-x-3">
                        <img src="{{ $item->product->image1 ? asset('storage/' . $item->product->image1) : 'https://via.placeholder.com/80' }}"
                             class="w-16 h-16 rounded border">
                        <div>
                            <p class="font-medium">{{ $item->product->name }}</p>
                            <p class="text-sm text-gray-500">Qty: {{ $item->quantity }}</p>
                        </div>
                    </div>
                    <p class="font-semibold">₹{{ number_format($item->product->price * $item->quantity, 2) }}</p>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Checkout Form -->
    <form id="checkout-form" action="{{ route('checkout.placeOrder') }}" method="POST" class="space-y-5">
        @csrf

        <!-- Address -->
        <div>
            <label class="block text-sm font-medium mb-1">Delivery Address <span class="text-red-500">*</span></label>
            <textarea name="address" rows="3"
                      class="w-full border rounded-lg p-2 @error('address') border-red-500 @enderror"
                      placeholder="Enter your full delivery address" required>{{ old('address') }}</textarea>
            @error('address')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Payment Method -->
        <div>
            <label class="block text-sm font-medium mb-1">Payment Method <span class="text-red-500">*</span></label>
            <select name="payment_method" class="w-full border rounded-lg p-2 @error('payment_method') border-red-500 @enderror" required>
                <option value="">-- Select Payment Method --</option>
                <option value="cod" {{ old('payment_method') == 'cod' ? 'selected' : '' }}>Cash on Delivery</option>
                <option value="online" {{ old('payment_method') == 'online' ? 'selected' : '' }}>Online Payment</option>
            </select>
            @error('payment_method')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Total -->
        <div class="flex justify-between items-center border-t pt-3">
            <p class="text-lg font-semibold">Total:</p>
            <p class="text-2xl font-bold text-indigo-600">₹{{ number_format($total, 2) }}</p>
        </div>

        <!-- Submit -->
        <button type="submit"
                class="w-full bg-indigo-600 text-white py-3 rounded-lg font-medium hover:bg-indigo-700 transition">
            Place Order
        </button>
    </form>
</section>
@endsection

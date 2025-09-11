@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<section class="bg-white shadow-xl rounded-2xl p-8 max-w-3xl mx-auto mt-20">
    <h1 class="text-3xl font-extrabold text-gray-800 mb-8 mt-10">🛒 Checkout</h1>

    <!-- Cart Items -->
    <div class="mb-8">
        <h2 class="text-xl font-semibold text-gray-700 mb-4">Your Items</h2>
        <div class="divide-y divide-gray-200">
            @foreach($cartItems as $item)
                <div class="flex justify-between py-4">
                    <div class="flex items-center space-x-4">
                        <img src="{{ $item->product->image1 ? asset('storage/' . $item->product->image1) : 'https://via.placeholder.com/80' }}"
                             class="w-16 h-16 rounded-lg border object-cover">
                        <div>
                            <p class="font-medium text-gray-800">{{ $item->product->name }}</p>
                            <p class="text-sm text-gray-500">Qty: {{ $item->quantity }}</p>
                        </div>
                    </div>
                    <p class="font-semibold text-gray-900">₹{{ number_format($item->product->price * $item->quantity, 2) }}</p>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Checkout Form -->
    <form id="checkout-form" action="{{ route('checkout.placeOrder') }}" method="POST" class="space-y-6">
        @csrf

        <!-- Name and Phone -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium mb-1">Full Name <span class="text-red-500">*</span></label>
                <input type="text" name="name" value="{{ old('name') }}"
                       class="w-full border rounded-lg p-3 @error('name') border-red-500 @enderror"
                       placeholder="e.g. John Doe" required>
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Phone Number <span class="text-red-500">*</span></label>
                <input type="text" name="phone" value="{{ old('phone') }}"
                       class="w-full border rounded-lg p-3 @error('phone') border-red-500 @enderror"
                       placeholder="e.g. 9876543210" required>
                @error('phone')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Address Fields -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
            <div>
                <label class="block text-sm font-medium mb-1">Building / Apartment Name <span class="text-red-500">*</span></label>
                <input type="text" name="building" value="{{ old('building') }}"
                       class="w-full border rounded-lg p-3 @error('building') border-red-500 @enderror"
                       placeholder="e.g. Sunshine Residency" required>
                @error('building')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Street / Road No <span class="text-red-500">*</span></label>
                <input type="text" name="street" value="{{ old('street') }}"
                       class="w-full border rounded-lg p-3 @error('street') border-red-500 @enderror"
                       placeholder="e.g. 5th Avenue Road" required>
                @error('street')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Landmark</label>
                <input type="text" name="landmark" value="{{ old('landmark') }}"
                       class="w-full border rounded-lg p-3"
                       placeholder="Near Central Mall">
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">City <span class="text-red-500">*</span></label>
                <input type="text" name="city" value="{{ old('city') }}"
                       class="w-full border rounded-lg p-3 @error('city') border-red-500 @enderror"
                       placeholder="e.g. Rajkot" required>
                @error('city')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">State <span class="text-red-500">*</span></label>
                <input type="text" name="state" value="{{ old('state') }}"
                       class="w-full border rounded-lg p-3 @error('state') border-red-500 @enderror"
                       placeholder="e.g. Gujarat" required>
                @error('state')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Pincode <span class="text-red-500">*</span></label>
                <input type="text" name="pincode" value="{{ old('pincode') }}"
                       class="w-full border rounded-lg p-3 @error('pincode') border-red-500 @enderror"
                       placeholder="e.g. 360001" required>
                @error('pincode')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Hidden Address Field (merged) -->
        <input type="hidden" name="address" id="full-address">

        <!-- Payment Method -->
        <div>
            <label class="block text-sm font-medium mb-1">Payment Method <span class="text-red-500">*</span></label>
            <select name="payment_method"
                    class="w-full border rounded-lg p-3 @error('payment_method') border-red-500 @enderror" required>
                <option value="">-- Select Payment Method --</option>
                <option value="cod" {{ old('payment_method') == 'cod' ? 'selected' : '' }}>Cash on Delivery</option>
                <option value="online" {{ old('payment_method') == 'online' ? 'selected' : '' }}>Online Payment</option>
            </select>
            @error('payment_method')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Total -->
        <div class="flex justify-between items-center border-t pt-4">
            <p class="text-lg font-semibold text-gray-700">Total:</p>
            <p class="text-2xl font-bold text-indigo-600">₹{{ number_format($total, 2) }}</p>
        </div>

        <!-- Submit -->
        <button type="submit"
                class="w-full bg-indigo-600 text-white py-3 rounded-lg font-semibold hover:bg-indigo-700 transition duration-200">
            Place Order
        </button>
    </form>
</section>

<!-- Script to merge address -->
<script>
document.getElementById("checkout-form").addEventListener("submit", function () {
    let building = document.querySelector("[name='building']").value;
    let street   = document.querySelector("[name='street']").value;
    let landmark = document.querySelector("[name='landmark']").value;
    let city     = document.querySelector("[name='city']").value;
    let state    = document.querySelector("[name='state']").value;
    let pincode  = document.querySelector("[name='pincode']").value;

    let fullAddress = `${building}, ${street}${landmark ? ', ' + landmark : ''}, ${city}, ${state} - ${pincode}`;
    document.getElementById("full-address").value = fullAddress;
});
</script>
@endsection

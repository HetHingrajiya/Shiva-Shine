@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<section class="bg-gray-50 py-12">
    <div class="max-w-5xl mx-auto px-6 lg:px-12">
        <h1 class="text-4xl font-bold text-gray-800 mb-8 text-center">🛒 Checkout</h1>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Section (Address + Payment) -->
            <div class="lg:col-span-2 space-y-8">

                <!-- Address Section -->
                <div class="bg-white shadow-lg rounded-xl p-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">📍 Shipping Address</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium mb-1">Building / Apartment <span class="text-red-500">*</span></label>
                            <input type="text" name="building" value="{{ old('building') }}"
                                   class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-indigo-500"
                                   placeholder="e.g. Sunshine Residency" required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-1">Street / Road No <span class="text-red-500">*</span></label>
                            <input type="text" name="street" value="{{ old('street') }}"
                                   class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-indigo-500"
                                   placeholder="e.g. 5th Avenue Road" required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-1">Landmark</label>
                            <input type="text" name="landmark" value="{{ old('landmark') }}"
                                   class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-indigo-500"
                                   placeholder="Near Central Mall">
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-1">City <span class="text-red-500">*</span></label>
                            <input type="text" name="city" value="{{ old('city') }}"
                                   class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-indigo-500"
                                   placeholder="e.g. Rajkot" required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-1">State <span class="text-red-500">*</span></label>
                            <input type="text" name="state" value="{{ old('state') }}"
                                   class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-indigo-500"
                                   placeholder="e.g. Gujarat" required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-1">Pincode <span class="text-red-500">*</span></label>
                            <input type="text" name="pincode" value="{{ old('pincode') }}"
                                   class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-indigo-500"
                                   placeholder="e.g. 360001" required>
                        </div>
                    </div>
                </div>

                <!-- Payment Section -->
                <div class="bg-white shadow-lg rounded-xl p-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">💳 Payment Method</h2>
                    <select name="payment_method" id="payment-method"
                            class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-indigo-500" required>
                        <option value="">-- Select Payment Method --</option>
                        <option value="cod" {{ old('payment_method') == 'cod' ? 'selected' : '' }}>Cash on Delivery</option>
                        <option value="online" {{ old('payment_method') == 'online' ? 'selected' : '' }}>Online Payment (Razorpay)</option>
                    </select>
                </div>
            </div>

            <!-- Right Section (Order Summary) -->
            <div>
                <div class="bg-white shadow-lg rounded-xl p-6 sticky top-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">🧾 Order Summary</h2>

                    <div class="divide-y divide-gray-200">
                        @foreach($cartItems as $item)
                            <div class="flex justify-between items-center py-4">
                                <div class="flex items-center space-x-4">
                                    <img src="{{ $item->product->image1 ? asset('storage/' . $item->product->image1) : 'https://via.placeholder.com/60' }}"
                                         class="w-14 h-14 rounded-lg border object-cover">
                                    <div>
                                        <p class="font-medium text-gray-800">{{ $item->product->name }}</p>
                                        <p class="text-sm text-gray-500">Qty: {{ $item->quantity }}</p>
                                    </div>
                                </div>
                                <p class="font-semibold text-gray-900">₹{{ number_format($item->product->price * $item->quantity, 2) }}</p>
                            </div>
                        @endforeach
                    </div>

                    <!-- Total -->
                    <div class="flex justify-between items-center border-t pt-4 mt-4">
                        <p class="text-lg font-semibold text-gray-700">Total:</p>
                        <p id="checkout-total" class="text-2xl font-bold text-indigo-600">₹{{ number_format($total, 2) }}</p>
                    </div>

                    <!-- Submit -->
                    <form id="checkout-form" action="{{ route('checkout.placeOrder') }}" method="POST" class="mt-6">
                        @csrf
                        <input type="hidden" name="address" id="full-address">
                        <button type="submit"
                                class="w-full bg-indigo-600 text-white py-3 rounded-lg font-semibold hover:bg-indigo-700 transition duration-200">
                            Place Order
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Razorpay Integration -->
<script>
document.getElementById("checkout-form").addEventListener("submit", function (e) {
    let building = document.querySelector("[name='building']").value;
    let street   = document.querySelector("[name='street']").value;
    let landmark = document.querySelector("[name='landmark']").value;
    let city     = document.querySelector("[name='city']").value;
    let state    = document.querySelector("[name='state']").value;
    let pincode  = document.querySelector("[name='pincode']").value;

    let fullAddress = `${building}, ${street}${landmark ? ', ' + landmark : ''}, ${city}, ${state} - ${pincode}`;
    document.getElementById("full-address").value = fullAddress;

    let paymentMethod = document.getElementById("payment-method").value;

    // ✅ If online payment selected → trigger Razorpay
    if(paymentMethod === "online"){
        e.preventDefault();

        let total = parseFloat(document.getElementById("checkout-total").innerText.replace(/[₹,]/g, ''));

        var options = {
            "key": "{{ config('services.razorpay.key') }}",
            "amount": total * 100,
            "currency": "INR",
            "name": "My Store",
            "description": "Order Payment",
            "handler": function (response){
                let input = document.createElement("input");
                input.type = "hidden";
                input.name = "razorpay_payment_id";
                input.value = response.razorpay_payment_id;
                document.getElementById("checkout-form").appendChild(input);
                document.getElementById("checkout-form").submit();
            },
            "prefill": {
                "name": "{{ Auth::user()->name }}",
                "email": "{{ Auth::user()->email }}"
            },
            "theme": { "color": "#4f46e5" }
        };

        var rzp = new Razorpay(options);
        rzp.open();
    }
});
</script>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
@endsection

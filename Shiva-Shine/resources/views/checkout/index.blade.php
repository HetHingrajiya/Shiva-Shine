@extends('layouts.app')

@section('content')
<section class="py-16 bg-gray-50 mt-16">
    <div class="max-w-7xl mx-auto px-4">
        <h1 class="text-3xl font-bold text-gray-900 mb-10">🛒 Checkout</h1>

        <div x-data="checkout()" x-init="init()">

            <!-- Cart Items -->
            <div class="lg:col-span-2 bg-white shadow-xl rounded-2xl p-6 border border-gray-100 mb-8">
                <h2 class="text-2xl font-semibold text-gray-800 mb-6">Your Items</h2>
                <div class="divide-y divide-gray-200">
                    @forelse($cartItems as $item)
                        <div class="flex items-center justify-between py-5">
                            <div class="flex items-center space-x-5">
                                <img src="{{ $item->product->image1 ? asset('storage/' . $item->product->image1) : 'https://via.placeholder.com/80' }}"
                                     alt="{{ $item->product->name }}"
                                     class="w-20 h-20 object-cover rounded-xl border border-gray-200 shadow-sm">
                                <div>
                                    <h3 class="text-lg font-medium text-gray-900">{{ $item->product->name }}</h3>
                                    <p class="text-sm text-gray-500">Quantity: {{ $item->quantity }}</p>
                                    <p class="text-sm text-gray-700">₹{{ number_format($item->product->price, 2) }} each</p>
                                </div>
                            </div>
                            <p class="text-lg font-bold text-indigo-600">
                                ₹{{ number_format($item->product->price * $item->quantity, 2) }}
                            </p>
                        </div>
                    @empty
                        <p class="text-gray-500 text-center py-6">Your cart is empty.</p>
                    @endforelse
                </div>
            </div>

            <!-- Address Section -->
            <div class="bg-white shadow-xl rounded-2xl p-6 border border-gray-100 mb-8">
                <h2 class="text-2xl font-semibold text-gray-800 mb-4">Delivery Address</h2>

                <template x-if="!addressConfirmed">
                    <div class="text-center">
                        <button @click="showAddressModal = true"
                                class="bg-indigo-600 text-white px-6 py-2 rounded-xl font-medium hover:bg-indigo-700 transition">
                            Add / Set Address
                        </button>
                        <p class="text-sm text-gray-500 mt-2">Please add your delivery address to proceed.</p>
                    </div>
                </template>

                <template x-if="addressConfirmed">
                    <div class="bg-gray-50 p-4 rounded-xl border border-gray-200">
                        <p class="font-medium text-gray-800" x-text="house + ', ' + street + (landmark ? ', ' + landmark : '')"></p>
                        <p class="text-gray-700" x-text="city + ', ' + state + ' - ' + pincode"></p>
                        <button @click="showAddressModal = true"
                                class="mt-3 text-indigo-600 hover:underline text-sm">
                            Edit Address
                        </button>
                    </div>
                </template>
            </div>

            <!-- Checkout Form -->
            <div x-show="addressConfirmed" x-transition class="bg-white shadow-xl rounded-2xl p-6 border border-gray-100">
                <h2 class="text-2xl font-semibold text-gray-800 mb-6">Billing & Payment</h2>

                <!-- Payment Error -->
                <div id="payment-error" class="hidden mb-4 p-3 bg-red-100 text-red-700 rounded"></div>

                <form id="checkout-form" method="POST" action="{{ route('checkout.placeOrder') }}" class="space-y-5">
                    @csrf
                    <!-- Hidden Address Fields -->
                    <input type="hidden" name="house" x-bind:value="house">
                    <input type="hidden" name="street" x-bind:value="street">
                    <input type="hidden" name="landmark" x-bind:value="landmark">
                    <input type="hidden" name="city" x-bind:value="city">
                    <input type="hidden" name="state" x-bind:value="state">
                    <input type="hidden" name="pincode" x-bind:value="pincode">

                    <!-- Payment Method -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Payment Method</label>
                        <div class="relative w-full">
                            <select id="payment-method" name="payment_method"
                                    class="w-full border border-gray-300 rounded-xl p-3 appearance-none pr-10 focus:ring-2 focus:ring-indigo-500 focus:outline-none
                                           bg-white cursor-pointer text-gray-700">
                                <option value="cod">Cash on Delivery</option>
                                <option value="online">Online Payment</option>
                            </select>
                            <!-- Arrow Icon -->
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Total -->
                    <div class="flex justify-between items-center py-4 border-t border-gray-200">
                        <p class="text-lg font-semibold text-gray-800">Total:</p>
                        <p class="text-2xl font-bold text-indigo-600">
                            ₹<span id="checkout-total">{{ number_format($total, 2) }}</span>
                        </p>
                    </div>

                    <!-- Place Order -->
                    <button type="submit" class="w-full bg-indigo-600 text-white py-3 rounded-xl font-medium hover:bg-indigo-700 transition duration-200 shadow-md">
                        Place Order
                    </button>
                </form>
            </div>

            <!-- Address Modal -->
            <div x-show="showAddressModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
                <div class="bg-white rounded-2xl shadow-xl p-6 w-full max-w-lg"
                     @keydown.escape.window="showAddressModal = false">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-4">Enter Delivery Address</h2>
                    <form @submit.prevent="confirmAddress()">
                        <div class="space-y-4">
                            <input type="text" placeholder="House / Building" class="w-full border rounded-xl p-3" required x-model="house">
                            <input type="text" placeholder="Street / Road" class="w-full border rounded-xl p-3" required x-model="street">
                            <input type="text" placeholder="Landmark (optional)" class="w-full border rounded-xl p-3" x-model="landmark">
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <input type="text" placeholder="City" class="w-full border rounded-xl p-3" required x-model="city">
                                <input type="text" placeholder="State" class="w-full border rounded-xl p-3" required x-model="state">
                            </div>
                            <input type="text" placeholder="Pincode" class="w-full border rounded-xl p-3" required x-model="pincode">
                        </div>
                        <div class="mt-6 flex justify-end">
                            <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-xl font-medium hover:bg-indigo-700 transition">Confirm Address</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
function checkout() {
    return {
        showAddressModal: false,
        addressConfirmed: false,
        house: '',
        street: '',
        landmark: '',
        city: '',
        state: '',
        pincode: '',
        init() {
            if(localStorage.getItem('checkoutAddress')) {
                let data = JSON.parse(localStorage.getItem('checkoutAddress'));
                Object.assign(this, data);
                this.addressConfirmed = true;
            }
        },
        confirmAddress() {
            this.addressConfirmed = true;
            this.showAddressModal = false;
            localStorage.setItem('checkoutAddress', JSON.stringify({
                house: this.house,
                street: this.street,
                landmark: this.landmark,
                city: this.city,
                state: this.state,
                pincode: this.pincode
            }));
        }
    }
}

document.getElementById("checkout-form").addEventListener("submit", function(e){
    let paymentMethod = document.getElementById("payment-method").value;

    if(paymentMethod === "online"){
        e.preventDefault();

        let total = parseFloat(document.getElementById("checkout-total").innerText.replace(/,/g,''));
        let options = {
            key: "{{ config('services.razorpay.key') }}",
            amount: total * 100,
            currency: "INR",
            name: "Your Store",
            description: "Secure Payment",
            handler: function(response){
                let form = document.getElementById("checkout-form");
                let input = document.createElement("input");
                input.type = "hidden";
                input.name = "razorpay_payment_id";
                input.value = response.razorpay_payment_id;
                form.appendChild(input);
                form.submit();
            },
            prefill: {
                name: "{{ auth()->user()->name ?? '' }}",
                email: "{{ auth()->user()->email ?? '' }}",
                contact: "{{ auth()->user()->phone ?? '' }}"
            },
            theme: { color: "#6366f1" },
            modal: {
                ondismiss: function(){
                    let errDiv = document.getElementById('payment-error');
                    errDiv.innerText = "Payment failed or cancelled. Please try again.";
                    errDiv.classList.remove('hidden');
                },
                escape: true,
                backdropclose: false
            }
        };

        new Razorpay(options).open();
    }
});
</script>
@endsection

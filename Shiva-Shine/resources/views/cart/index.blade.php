@extends('layouts.app')

@section('content')
<!-- ===== Cart Section ===== -->
<section class="w-full bg-[#fffaf7] py-12 min-h-screen mt-10">
    <div class="max-w-7xl mx-auto px-4">
        <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-8">My Cart</h2>

        @if(true) {{-- Replace with count($cartItems) > 0 in real logic --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @for($i = 0; $i < 3; $i++)
                    <div class="border rounded-lg overflow-hidden bg-white shadow-sm hover:shadow-md transition">
                        <img src="https://via.placeholder.com/400x250" alt="Product Image" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <h3 class="text-lg font-semibold text-gray-900">Product Name {{ $i+1 }}</h3>
                            <p class="text-sm text-gray-600 mb-2">A short product description with features and benefits.</p>
                            <div class="flex items-center justify-between mt-4">
                                <span class="text-pink-600 font-bold text-lg">₹999</span>
                                <form method="POST" action="#">
                                    @csrf
                                    <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium">Remove</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>

            {{-- Cart Summary --}}
            <div class="mt-12 bg-white shadow rounded p-6 max-w-xl mx-auto">
                <h3 class="text-xl font-semibold mb-4">Order Summary</h3>
                <div class="flex justify-between text-gray-700 mb-2">
                    <span>Subtotal</span>
                    <span>₹2997</span>
                </div>
                <div class="flex justify-between text-gray-700 mb-2">
                    <span>Shipping</span>
                    <span>₹50</span>
                </div>
                <div class="flex justify-between text-gray-900 font-bold border-t pt-4">
                    <span>Total</span>
                    <span>₹3047</span>
                </div>
                <a href="#" class="mt-6 block w-full text-center bg-pink-600 hover:bg-pink-700 text-white font-medium py-2 rounded transition">
                    Proceed to Checkout
                </a>
            </div>
        @else
            <div class="text-center py-20">
                <img src="https://via.placeholder.com/200x200?text=Empty+Cart" alt="Empty Cart" class="mx-auto w-48 mb-6">
                <p class="text-lg text-gray-600">Your cart is currently empty.</p>
                <a href="#" class="mt-4 inline-block bg-pink-600 text-white px-6 py-2 rounded hover:bg-pink-700 transition">
                    Browse Products
                </a>
            </div>
        @endif
    </div>
</section>
@endsection

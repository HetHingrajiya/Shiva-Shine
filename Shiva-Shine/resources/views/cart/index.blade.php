@extends('layouts.app')

@section('content')
<!-- ===== Cart Section ===== -->
<section class="w-full bg-[#fffaf7] py-12 min-h-screen mt-20">
    <div class="max-w-7xl mx-auto px-4 md:px-6 lg:px-8 mt-10">
    
        <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-8">My Cart</h2>

        @php
            $cartItems = [
                [
                    'id' => 1,
                    'name' => 'Rose Gold Necklace',
                    'description' => 'Elegant rose gold finish necklace for daily wear.',
                    'price' => 999,
                    'image' => 'https://via.placeholder.com/400x250?text=Product+1',
                ],
                [
                    'id' => 2,
                    'name' => 'Silver Bracelet',
                    'description' => 'Premium silver bracelet with adjustable strap.',
                    'price' => 1499,
                    'image' => 'https://via.placeholder.com/400x250?text=Product+2',
                ],
                [
                    'id' => 3,
                    'name' => 'Gold Ring',
                    'description' => 'Stylish gold-plated ring, perfect for gifting.',
                    'price' => 799,
                    'image' => 'https://via.placeholder.com/400x250?text=Product+3',
                ],
            ];

            $subtotal = array_sum(array_column($cartItems, 'price'));
            $shipping = 50;
            $total = $subtotal + $shipping;
        @endphp

        @if(count($cartItems) > 0)
            <!-- Products List -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($cartItems as $item)
                    <div class="border rounded-lg overflow-hidden bg-white shadow-sm hover:shadow-md transition">
                        <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <h3 class="text-lg font-semibold text-gray-900">{{ $item['name'] }}</h3>
                            <p class="text-sm text-gray-600 mb-2">{{ $item['description'] }}</p>
                            <div class="flex items-center justify-between mt-4">
                                <span class="text-pink-600 font-bold text-lg">₹{{ $item['price'] }}</span>
                                <form method="POST" action="{{ route('cart.remove', $item['id']) }}">
                                    @csrf
                                    <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium">Remove</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Cart Summary -->
            <div class="mt-12 bg-white shadow rounded p-6 max-w-xl mx-auto">
                <h3 class="text-xl font-semibold mb-4">Order Summary</h3>
                <div class="flex justify-between text-gray-700 mb-2">
                    <span>Subtotal</span>
                    <span>₹{{ $subtotal }}</span>
                </div>
                <div class="flex justify-between text-gray-700 mb-2">
                    <span>Shipping</span>
                    <span>₹{{ $shipping }}</span>
                </div>
                <div class="flex justify-between text-gray-900 font-bold border-t pt-4">
                    <span>Total</span>
                    <span>₹{{ $total }}</span>
                </div>
                <a href="#" class="mt-6 block w-full text-center bg-pink-600 hover:bg-pink-700 text-white font-medium py-2 rounded transition">
                    Proceed to Checkout
                </a>
            </div>
        @else
            <!-- Empty Cart -->
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

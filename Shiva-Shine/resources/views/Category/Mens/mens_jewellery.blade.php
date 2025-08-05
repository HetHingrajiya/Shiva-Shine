@extends('layouts.app')

@section('content')
 <!-- ===== Fullscreen Banners Section ===== -->
    <section class="w-full bg-[#fffaf7]">

        <!-- Desktop Banner (visible on md and up) -->
        <div class="hidden md:block mt-14">
            <img src="{{ asset('images/files/106_rakhi_gold_jewellery__offer_hero_web-minda97.jpg') }}" alt="Desktop Banner"
                class="w-full h-auto object-cover" />
        </div>

        <!-- Mobile Banner (visible below md) -->
        <div class="md:hidden mt-20">
            <img src="{{ asset('images/files/106_rakhi_gold_jewellery__offer_hero_phone_-min5d78.jpg') }}" alt="Mobile Banner"
                class="w-full h-auto object-cover" />
        </div>

    </section>
    <h2 class="text-2xl font-bold text-center mb-6">Men's Jewellery</h2>

    @php
        $products = [
            [
                'name' => 'Silver Bracelet',
                'image' => 'images/mens-bracelet.jpg',
                'price' => 1499,
            ],
            [
                'name' => 'Black Leather Chain',
                'image' => 'images/leather-chain.jpg',
                'price' => 1299,
            ],
            [
                'name' => 'Steel Ring',
                'image' => 'images/steel-ring.jpg',
                'price' => 999,
            ],
            [
                'name' => 'Classic Watch',
                'image' => 'images/classic-watch.jpg',
                'price' => 2999,
            ],
        ];
    @endphp

    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 max-w-6xl mx-auto px-4">
        @foreach($products as $product)
            <div class="bg-white rounded-lg shadow hover:shadow-md transition p-4 text-center">
                <img src="{{ asset($product['image']) }}" alt="{{ $product['name'] }}" class="w-full aspect-square object-cover rounded mb-3">
                <h3 class="font-semibold text-gray-800 truncate">{{ $product['name'] }}</h3>
                <p class="text-pink-600 font-bold text-lg">₹{{ number_format($product['price']) }}</p>
                <button class="mt-3 bg-pink-100 hover:bg-pink-200 text-[#633d2e] font-semibold py-1.5 px-4 rounded">
                    Add to Cart
                </button>
            </div>
        @endforeach
    </div>
@endsection

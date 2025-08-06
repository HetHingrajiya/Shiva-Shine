@extends('layouts.app')

@section('content')
<!-- ===== Fullscreen Banners Section ===== -->
<section class="w-full bg-[#fffaf7]">
    <!-- Desktop Banner -->
    <div class="hidden md:block mt-14">
        <img src="{{ asset('images/files/106_rakhi_gold_jewellery__offer_hero_web-minda97.jpg') }}" alt="Desktop Banner"
            class="w-full h-auto object-cover" />
    </div>
    <!-- Mobile Banner -->
    <div class="md:hidden mt-20">
        <img src="{{ asset('images/files/106_rakhi_gold_jewellery__offer_hero_phone_-min5d78.jpg') }}" alt="Mobile Banner"
            class="w-full h-auto object-cover" />
    </div>
</section>
<!-- Filter Dropdown -->
<div class="mb-6 text-right mt-10 max-w-6xl mx-auto px-4">
    <label for="categoryFilter" class="mr-2 font-semibold text-[#633d2e]">Filter by Category:</label>
    <select id="categoryFilter" onchange="filterProducts()"
        class="border border-[#d7ccc8] rounded px-4 py-2 text-sm text-[#633d2e] bg-white shadow-sm focus:ring-2 focus:ring-pink-300">
        <option value="all">All</option>
        <option value="Earrings">Earrings</option>
        <option value="Necklace">Necklace</option>
        <option value="Ring">Ring</option>
        <option value="Bracelet">Bracelet</option>
        <option value="Bangles">Bangles</option>
    </select>
</div>

<!-- Section Heading -->
<h2 class="text-3xl font-bold text-center text-[#633d2e] mb-8">Women's Jewellery Collection</h2>

@php
    $products = [
        [
            'name' => 'Gold Earrings',
            'image' => 'images/women-earrings.jpg',
            'price' => 1899,
            'category' => 'Earrings',
        ],
        [
            'name' => 'Diamond Necklace',
            'image' => 'images/diamond-necklace.jpg',
            'price' => 4999,
            'category' => 'Necklace',
        ],
        [
            'name' => 'Rose Gold Ring',
            'image' => 'images/rose-gold-ring.jpg',
            'price' => 1599,
            'category' => 'Ring',
        ],
        [
            'name' => 'Pearl Bracelet',
            'image' => 'images/pearl-bracelet.jpg',
            'price' => 1399,
            'category' => 'Bracelet',
        ],
        [
            'name' => 'Traditional Bangles',
            'image' => 'images/traditional-bangles.jpg',
            'price' => 1799,
            'category' => 'Bangles',
        ],
    ];
@endphp

<!-- Products Grid -->
<div id="productGrid" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 max-w-6xl mx-auto px-4 pb-16">
    @foreach ($products as $product)
        <div class="product-card bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-lg transition transform hover:-translate-y-1 duration-300"
            data-category="{{ $product['category'] }}">
            <img src="{{ asset($product['image']) }}" alt="{{ $product['name'] }}"
                class="w-full aspect-square object-cover">
            <div class="p-4">
                <h3 class="font-semibold text-lg text-[#2f2f2f] truncate mb-1">{{ $product['name'] }}</h3>
                <p class="text-pink-600 font-bold text-xl mb-3">₹{{ number_format($product['price']) }}</p>
                <button
                    class="w-full bg-pink-100 hover:bg-pink-200 text-[#633d2e] font-semibold py-2 rounded-lg transition">Add
                    to Cart</button>
            </div>
        </div>
    @endforeach
</div>

<!-- Coming Soon Layout -->
<div id="comingSoon" class="hidden text-center py-20 max-w-xl mx-auto">
    <img src="{{ asset('images/coming-soon.png') }}" alt="Coming Soon"
        class="mx-auto w-52 h-52 object-contain mb-6 opacity-90">
    <h3 class="text-2xl font-bold text-[#633d2e] mb-2">Coming Soon</h3>
    <p class="text-gray-600">We're working on adding more products in this category. Stay tuned!</p>
</div>

<!-- Filter Script -->
<script>
    function filterProducts() {
        const selectedCategory = document.getElementById('categoryFilter').value;
        const cards = document.querySelectorAll('.product-card');
        let anyVisible = false;

        cards.forEach(card => {
            const cardCategory = card.getAttribute('data-category');
            if (selectedCategory === 'all' || cardCategory === selectedCategory) {
                card.classList.remove('hidden');
                anyVisible = true;
            } else {
                card.classList.add('hidden');
            }
        });

        const comingSoon = document.getElementById('comingSoon');
        const productGrid = document.getElementById('productGrid');

        if (!anyVisible) {
            comingSoon.classList.remove('hidden');
            productGrid.classList.add('hidden');
        } else {
            comingSoon.classList.add('hidden');
            productGrid.classList.remove('hidden');
        }
    }
</script>
@endsection

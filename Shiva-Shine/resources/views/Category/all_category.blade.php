@extends('layouts.app') <!-- Optional, based on your layout -->

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

    <section class="py-10 bg-[#fffaf7]">
        <div class="max-w-6xl mx-auto px-4">

            <!-- Heading -->
            <h2 class="text-3xl font-semibold text-center text-[#633d2e] mb-6">Featured Products</h2>

            <!-- Filter Dropdown -->
            <div class="mb-4 text-right">
                <label for="categoryFilter" class="mr-2 font-semibold text-[#633d2e]">Filter by Category:</label>
                <select id="categoryFilter" onchange="filterProducts()"
                    class="border rounded px-3 py-1 text-sm text-[#633d2e] bg-white shadow">
                    <option value="all">All</option>
                    <option value="Rings">Rings</option>
                    <option value="Bracelet">Bracelet</option>
                    <option value="Pendant">Pendant</option>
                </select>
            </div>

            <!-- Product Grid -->
            <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @php
                    $products = [
                        [
                            'name' => 'His & Her Rings',
                            'price' => 2499,
                            'category' => 'Rings',
                            'image' => 'images/files/Untitled-1.jpg',
                        ],
                        [
                            'name' => 'Couple Bracelets',
                            'price' => 2999,
                            'category' => 'Bracelet',
                            'image' => 'images/files/Untitled-1.jpg',
                        ],
                        [
                            'name' => 'Lock & Key Pendants',
                            'price' => 3199,
                            'category' => 'Pendant',
                            'image' => 'images/files/Untitled-1.jpg',
                        ],
                        [
                            'name' => 'Name Engraved Rings',
                            'price' => 2799,
                            'category' => 'Rings',
                            'image' => 'images/files/Untitled-1.jpg',
                        ],
                        [
                            'name' => 'Heart Pendant',
                            'price' => 2599,
                            'category' => 'Pendant',
                            'image' => 'images/files/Untitled-1.jpg',
                        ],
                        [
                            'name' => 'Men’s Bracelet',
                            'price' => 3299,
                            'category' => 'Bracelet',
                            'image' => 'images/files/Untitled-1.jpg',
                        ],
                        [
                            'name' => 'Promise Rings',
                            'price' => 2199,
                            'category' => 'Rings',
                            'image' => 'images/files/Untitled-1.jpg',
                        ],
                        [
                            'name' => 'Initial Pendant',
                            'price' => 2999,
                            'category' => 'Pendant',
                            'image' => 'images/files/Untitled-1.jpg',
                        ],
                    ];
                @endphp

                @foreach ($products as $product)
                    <div data-category="{{ $product['category'] }}"
                        class="bg-white rounded-lg overflow-hidden shadow-sm relative group transition transform hover:-translate-y-1">

                        <!-- Wishlist Icon -->
                        <button class="absolute top-2 right-2 z-10 text-gray-500 hover:text-red-500 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 fill-current" viewBox="0 0 24 24">
                                <path d="M12.1 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5
                                            2 5.42 4.42 3 7.5 3c1.74 0 3.41 0.81
                                            4.5 2.09C13.09 3.81 14.76 3 16.5 3
                                            19.58 3 22 5.42 22 8.5c0 3.78-3.4
                                            6.86-8.55 11.54l-1.35 1.31z" />
                            </svg>
                        </button>

                        <!-- Product Image -->
                        <img src="{{ asset($product['image']) }}" alt="{{ $product['name'] }}"
                            class="w-full aspect-[4/5] object-cover group-hover:scale-105 transition-transform duration-300" />

                        <!-- Rating -->
                        <div
                            class="absolute bottom-28 left-2 bg-white bg-opacity-90 rounded px-2 text-sm text-yellow-500 font-semibold flex items-center gap-1">
                            <span>4.8</span>
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                <path d="M12 .587l3.668 7.568L24 9.423l-6 5.845
                                            1.416 8.232L12 18.896l-7.416 4.604L6
                                            15.268 0 9.423l8.332-1.268z" />
                            </svg>
                            <span class="text-gray-600">(134)</span>
                        </div>

                        <!-- Product Info -->
                        <div class="p-3 text-center space-y-1">
                            <p class="text-gray-700 font-semibold text-sm truncate">{{ $product['name'] }}</p>
                            <p class="text-[#d33f5f] font-bold text-lg">
                                ₹{{ number_format($product['price']) }}
                                <span
                                    class="text-gray-400 line-through text-sm ml-1">₹{{ number_format($product['price'] + 1500) }}</span>
                            </p>
                        </div>

                        <!-- Add to Cart Button -->
                        <button
                            class="w-full bg-[#ffd9df] hover:bg-[#fcb8c5] text-[#633d2e] font-semibold py-2 rounded-b transition">
                            Add to Cart
                        </button>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Filter Script -->
    <script>
        function filterProducts() {
            const selectedCategory = document.getElementById('categoryFilter').value;
            const cards = document.querySelectorAll('[data-category]');

            cards.forEach(card => {
                const cardCategory = card.getAttribute('data-category');
                if (selectedCategory === 'all' || cardCategory === selectedCategory) {
                    card.classList.remove('hidden');
                } else {
                    card.classList.add('hidden');
                }
            });
        }
    </script>
@endsection

@extends('layouts.app')

@section('content')
    <!-- ======= Hero Banner Section ======= -->
    <section class="w-full bg-[#fffaf7] py-12 mt-20">
        <!-- Desktop Banner -->
        <div class="hidden md:block mt-8">
            <img src="{{ asset('images/files/106_rakhi_gold_jewellery__offer_hero_web-minda97.jpg') }}" alt="Desktop Banner"
                class="w-full object-cover rounded-md shadow-md" />
        </div>

        <!-- Mobile Banner -->
        <div class="md:hidden mt-6">
            <img src="{{ asset('images/files/106_rakhi_gold_jewellery__offer_hero_phone_-min5d78.jpg') }}" alt="Mobile Banner"
                class="w-full object-cover rounded-md shadow-md" />
        </div>
    </section>

    <!-- ======= Women's Jewellery Section ======= -->
    <section class="py-14 bg-[#fffaf7]">
        <div class="max-w-7xl mx-auto px-4">
            <!-- Section Header with Filter -->
            <div class="flex justify-between items-center mb-8 flex-col sm:flex-row gap-4">
                <h2 class="text-3xl font-bold text-[#633d2e]">Women's Jewellery Collection</h2>

                <!-- Category Filter -->
                <div class="flex items-center gap-2">
                    <label for="categoryFilter" class="text-sm font-semibold text-[#633d2e]">Category:</label>
                    <select id="categoryFilter" onchange="filterProducts()"
                        class="border border-[#e0c4ae] rounded-lg px-3 py-1.5 text-sm bg-white shadow-sm text-[#633d2e] focus:outline-none">
                        <option value="all">All</option>
                        <option value="Earrings">Earrings</option>
                        <option value="Necklace">Necklace</option>
                        <option value="Ring">Ring</option>
                        <option value="Bracelet">Bracelet</option>
                        <option value="Bangles">Bangles</option>
                    </select>
                </div>
            </div>

            <!-- Product Grid -->
            <div class="grid gap-6 grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4" id="productGrid">
                @foreach ($products as $product)
                    <div data-category="{{ $product->category ?? 'Uncategorized' }}"
                        class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition relative group">

                        <!-- Wishlist Button -->
                        <button class="absolute top-3 right-3 z-10 text-gray-400 hover:text-red-500 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 fill-current" viewBox="0 0 24 24">
                                <path d="M12.1 21.35l-1.45-1.32C5.4 15.36 2
                                    12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74
                                    0 3.41 0.81 4.5 2.09C13.09 3.81
                                    14.76 3 16.5 3 19.58 3 22 5.42
                                    22 8.5c0 3.78-3.4 6.86-8.55
                                    11.54l-1.35 1.31z" />
                            </svg>
                        </button>


                        <!-- Image -->
                        <div class="relative">
                            <img src="{{ asset('storage/' . $product->image1) }}"
                                data-hover="{{ $product->image2 ? asset('storage/' . $product->image2) : asset('storage/' . $product->image1) }}"
                                class="h-full w-full aspect-[4/5] object-cover transition duration-500 group-hover:scale-[1.03]"
                                onmouseover="this.src=this.dataset.hover;"
                                onmouseout="this.src='{{ asset('storage/' . $product->image1) }}';"
                                alt="{{ $product->name }}">
                        </div>

                        <!-- Product Info -->
                        <div class="p-4 text-center">
                            <h3 class="text-md font-semibold text-gray-800 truncate">{{ $product->name }}</h3>
                            <p class="text-[#d33f5f] font-bold text-lg">
                                ₹{{ number_format($product->price) }}
                                <span class="line-through text-sm text-gray-400 ml-1">
                                    ₹{{ number_format($product->price + 1500) }}
                                </span>
                            </p>

                            <!-- Rating -->
                            <div class="flex items-center justify-center mt-1 gap-1 text-yellow-500 text-sm">
                                <span>{{ $product->rating ?? '4.8' }}</span>
                                <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                    <path d="M12 .587l3.668 7.568L24 9.423l-6 5.845
                                        1.416 8.232L12 18.896l-7.416 4.604L6
                                        15.268 0 9.423l8.332-1.268z" />
                                </svg>
                                <span class="text-gray-600">({{ $product->reviews_count ?? 134 }})</span>
                            </div>

                            <!-- Add to Cart -->
                            <button
                                class="w-full bg-pink-100 hover:bg-pink-200 text-[#633d2e] font-semibold py-2 rounded-lg transition">
                                Add to Cart
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Coming Soon Placeholder -->
            <div id="comingSoon" class="hidden text-center py-20 max-w-xl mx-auto">
                <img src="{{ asset('images/coming-soon.png') }}" alt="Coming Soon"
                    class="mx-auto w-52 h-52 object-contain mb-6 opacity-90">
                <h3 class="text-2xl font-bold text-[#633d2e] mb-2">Coming Soon</h3>
                <p class="text-gray-600">We're working on adding more products in this category. Stay tuned!</p>
            </div>
        </div>
    </section>

    <!-- ======= Filter Script ======= -->
    <script>
        function filterProducts() {
            const selected = document.getElementById('categoryFilter').value;
            const cards = document.querySelectorAll('[data-category]');
            let visibleCount = 0;

            cards.forEach(card => {
                const cat = card.getAttribute('data-category');
                const isVisible = selected === 'all' || cat === selected;
                card.classList.toggle('hidden', !isVisible);
                if (isVisible) visibleCount++;
            });

            document.getElementById('productGrid').classList.toggle('hidden', visibleCount === 0);
            document.getElementById('comingSoon').classList.toggle('hidden', visibleCount > 0);
        }
    </script>
@endsection

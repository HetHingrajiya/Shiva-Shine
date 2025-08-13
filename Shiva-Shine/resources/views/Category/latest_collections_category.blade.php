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

    <!-- ======= Featured Products Section ======= -->
    <section class="py-14 bg-[#fffaf7]">
        <div class="max-w-7xl mx-auto px-4">
            <!-- Section Heading & Filter -->
            <div class="flex justify-between items-center mb-8 flex-col sm:flex-row gap-4">
                <h2 class="text-3xl font-bold text-[#633d2e] text-center sm:text-left">Latest Collections by Category</h2>
                <div class="flex items-center gap-2">
                    <label for="categoryFilter" class="text-sm font-semibold text-[#633d2e]">Category:</label>
                    <select id="categoryFilter" onchange="filterProducts()"
                        class="border border-[#e0c4ae] rounded-lg px-3 py-1.5 text-sm bg-white shadow-sm text-[#633d2e] focus:outline-none">
                        <option value="all">All</option>
                        <option value="Rings">Rings</option>
                        <option value="Bracelet">Bracelet</option>
                        <option value="Pendant">Pendant</option>
                    </select>
                </div>
            </div>

            <!-- Product Grid -->
            <div class="grid gap-6 grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4" id="productGrid">
                @foreach ($products as $product)
                    <div data-category="{{ $product->category }}"
                        class="bg-white rounded-2xl overflow-hidden shadow-sm relative group transition transform hover:-translate-y-1 hover:shadow-md">

                        <!-- Wishlist Icon -->
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

                        <!-- Product Image -->
                        <img src="{{ asset('storage/' . $product->image1) }}" alt="{{ $product->name }}"
                            class="w-full object-cover transition-transform duration-300 group-hover:scale-105" />

                        <!-- Product Details -->
                        <div class="p-4 text-center space-y-1">
                            <p class="text-gray-800 font-semibold text-sm truncate">{{ $product->name }}</p>
                            <p class="text-[#d33f5f] font-bold text-lg">
                                ₹{{ number_format($product->price) }}
                                <span class="line-through text-sm text-gray-400 ml-1">
                                    ₹{{ number_format($product->price + 1500) }}
                                </span>
                            </p>

                            <!-- Rating -->
                            <div class="flex items-center justify-center gap-1 text-yellow-500 text-sm">
                                <span>4.8</span>
                                <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                    <path d="M12 .587l3.668 7.568L24 9.423l-6 5.845
                                        1.416 8.232L12 18.896l-7.416 4.604L6
                                        15.268 0 9.423l8.332-1.268z" />
                                </svg>
                                <span class="text-gray-600">(134)</span>
                            </div>

                            <!-- Add to Cart -->
                            <button
                                class="w-full mt-2 bg-pink-100 hover:bg-pink-200 text-[#633d2e] font-semibold py-2 rounded-lg transition">
                                Add to Cart
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- ======= Filter Script ======= -->
    <script>
        function filterProducts() {
            const selected = document.getElementById('categoryFilter').value;
            const products = document.querySelectorAll('[data-category]');

            products.forEach(card => {
                const cat = card.getAttribute('data-category');
                card.classList.toggle('hidden', selected !== 'all' && cat !== selected);
            });
        }
    </script>
@endsection

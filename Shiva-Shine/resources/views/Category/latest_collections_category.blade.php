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

                <!-- Filters -->
                <div class="flex flex-wrap items-center gap-4">
                    <!-- Gender Filter -->
                    <div class="flex items-center gap-2">
                        <label for="genderFilter" class="text-sm font-semibold text-[#633d2e]">Gender:</label>
                        <select id="genderFilter" name="gender" onchange="applyFilters()"
                            class="border border-[#e0c4ae] rounded-lg px-3 py-1.5 text-sm bg-white shadow-sm text-[#633d2e] focus:outline-none">
                            <option value="all" {{ request('gender') == 'all' ? 'selected' : '' }}>All</option>
                            <option value="male" {{ request('gender') == 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ request('gender') == 'female' ? 'selected' : '' }}>Female</option>
                        </select>
                    </div>

                    <!-- Category Filter -->
                    <div class="flex items-center gap-2">
                        <label for="categoryFilter" class="text-sm font-semibold text-[#633d2e]">Category:</label>
                        <select id="categoryFilter" name="category_id" onchange="applyFilters()"
                            class="border border-[#e0c4ae] rounded-lg px-3 py-1.5 text-sm bg-white shadow-sm text-[#633d2e] focus:outline-none">
                            <option value="all" {{ request('category_id') == 'all' ? 'selected' : '' }}>All</option>
                            @foreach ($categories as $category)
                                @if (strtolower($category->gender) === strtolower(request('gender')) || request('gender') == 'all')
                                    <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>

            </div>

            <!-- Product Grid -->
            <div class="grid gap-6 grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4" id="productGrid">
                @if (count($products) > 0)
                    @foreach ($products as $product)
                        <!-- ✅ Whole Card Clickable -->
                        <a href="{{ route('products.show', $product->id) }}"
                            data-category="{{ $product->category }}"
                            class="block bg-white rounded-2xl overflow-hidden shadow-sm relative group transition transform hover:shadow-md">

                            <!-- Wishlist Icon -->
                            <button type="button"
                                    onclick="event.preventDefault(); event.stopPropagation();"
                                    class="absolute top-3 right-3 z-10 text-gray-400 hover:text-red-500 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 fill-current" viewBox="0 0 24 24">
                                    <path d="M12.1 21.35l-1.45-1.32C5.4 ..." />
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
                                <button type="button"
                                    onclick="event.preventDefault(); event.stopPropagation();"
                                    class="w-full mt-2 bg-pink-100 hover:bg-pink-200 text-[#633d2e] font-semibold py-2 rounded-lg transition">
                                    Add to Cart
                                </button>
                            </div>
                        </a>
                    @endforeach
                @else
                    <!-- Coming Soon Message -->
                    <div class="col-span-2 sm:col-span-2 md:col-span-3 lg:col-span-4 flex flex-col items-center justify-center py-16 text-center bg-white rounded-2xl shadow-sm">
                        <img src="{{ asset('https://static.vecteezy.com/system/resources/thumbnails/022/443/371/small/coming-soon-text-comic-speech-bubble-illustration-png.png') }}" alt="Coming Soon" class="w-40 mb-6 opacity-80">
                        <h3 class="text-2xl font-bold text-[#633d2e] mb-2">Coming Soon</h3>
                        <p class="text-gray-600 text-sm">We’re preparing something special for this category. Stay tuned!</p>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Filter Script -->
    <script>
        function applyFilters() {
            let gender = document.getElementById('genderFilter').value;
            let category = document.getElementById('categoryFilter').value;

            let url = "{{ route('Category.latest_collections_category') }}?";

            if (gender !== "all") url += "gender=" + gender + "&";
            if (category !== "all") url += "category_id=" + category;

            // Remove trailing '&' or '?' if empty
            url = url.replace(/[&?]$/, "");

            window.location.href = url;
        }
    </script>
@endsection

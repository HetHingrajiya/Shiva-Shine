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
    <!-- ======= Products Section ======= -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="mb-8">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
                <h2 class="text-3xl font-extrabold text-gray-800 mb-4 md:mb-0">All Products</h2>

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
            @forelse ($products as $product)
            <a href="{{ route('products.show', ['id' => Crypt::encrypt($product->id)]) }}"
                   class="block bg-white rounded-2xl overflow-hidden shadow-sm relative group transition transform hover:shadow-md">

                    <!-- Wishlist Button -->
                    <button type="button"
                            class="absolute top-3 right-3 z-10 wishlist-btn {{ in_array($product->id, $wishlist ?? []) ? 'text-red-500' : 'text-gray-400' }}"
                            data-id="{{ $product->id }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 fill-current" viewBox="0 0 24 24">
                            <path d="M12.1 21.35l-1.45-1.32C5.4 15.36
                                    2 12.28 2 8.5 2 5.42 4.42 3
                                    7.5 3c1.74 0 3.41 0.81 4.5
                                    2.09C13.09 3.81 14.76 3
                                    16.5 3 19.58 3 22 5.42 22
                                    8.5c0 3.78-3.4 6.86-8.55
                                    11.54L12.1 21.35z"/>
                        </svg>
                    </button>

                    <!-- Product Image -->
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
                                <path d="M12 .587l3.668 7.568L24 9.423l-6 5.845 1.416 8.232L12 18.896l-7.416 4.604L6 15.268 0 9.423l8.332-1.268z" />
                            </svg>
                            <span class="text-gray-600">(134)</span>
                        </div>

                        <!-- Add to Cart -->
                        <button type="button"
                            class="add-to-cart-btn w-full bg-pink-100 hover:bg-pink-200 text-[#633d2e] font-semibold py-2 rounded-lg transition"
                            data-id="{{ $product->id }}">
                        Add to Cart
                    </button>
                    </div>
                </a>
            @empty
                <div class="col-span-2 sm:col-span-2 md:col-span-3 lg:col-span-4 flex flex-col items-center justify-center py-16 text-center bg-white rounded-2xl shadow-sm">
                    <img src="https://static.vecteezy.com/system/resources/thumbnails/022/443/371/small/coming-soon-text-comic-speech-bubble-illustration-png.png"
                         alt="Coming Soon" class="w-40 mb-6 opacity-80">
                    <h3 class="text-2xl font-bold text-[#633d2e] mb-2">Coming Soon</h3>
                    <p class="text-gray-600 text-sm">We’re preparing something special for this category. Stay tuned!</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- ======= Scripts ======= -->
<script>
    // Apply Gender & Category Filters
    function applyFilters() {
        let gender = document.getElementById('genderFilter').value;
        let category = document.getElementById('categoryFilter').value;
        let url = "{{ route('Category.latest_collections_category') }}?";
        if (gender !== "all") url += "gender=" + gender + "&";
        if (category !== "all") url += "category_id=" + category;
        url = url.replace(/[&?]$/, "");
        window.location.href = url;
    }

    // Wishlist AJAX Toggle
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.wishlist-btn').forEach(button => {
            button.addEventListener('click', function (e) {
                e.preventDefault();
                e.stopPropagation(); // Prevent parent <a> click

                @if(Auth::check())
                let productId = this.dataset.id;
                let btn = this;

                fetch("{{ route('wishlist.toggle') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({ product_id: productId })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'added') {
                        btn.classList.remove('text-gray-400');
                        btn.classList.add('text-red-500');
                    } else if (data.status === 'removed') {
                        btn.classList.remove('text-red-500');
                        btn.classList.add('text-gray-400');
                    }
                })
                .catch(err => console.error(err));
                @else
                    alert('Please login to add to wishlist');
                @endif
            });
        });
    });
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.add-to-cart-btn').forEach(button => {
            button.addEventListener('click', function (e) {
                e.preventDefault();

                let productId = this.dataset.id;
                let btn = this;

                @if(Auth::check())
                fetch("{{ route('cart.add') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({ product_id: productId, quantity: 1 })
                })
                .then(res => res.json())
                .then(data => {
                    if(data.status === 'success') {
                        btn.innerText = 'Added ✅';
                        btn.disabled = true;
                        // Optional: update cart count in header
                        const cartCountElem = document.getElementById('cartCount');
                        if(cartCountElem) cartCountElem.innerText = data.cart_count;
                    } else {
                        alert(data.message);
                    }
                })
                .catch(err => console.error(err));
                @else
                    alert('Please login to add products to cart');
                @endif
            });
        });
    });
</script>
@endsection

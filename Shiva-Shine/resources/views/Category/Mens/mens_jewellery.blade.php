@extends('layouts.app')

@section('content')
<!-- ======= Hero Banner Section ======= -->
<section class="w-full bg-[#fffaf7] py-12 mt-20">
    <div class="hidden md:block mt-8">
        <img src="{{ asset('images/files/106_rakhi_gold_jewellery__offer_hero_web-minda97.jpg') }}"
             alt="Desktop Banner"
             class="w-full object-cover rounded-md shadow-md" />
    </div>
    <div class="md:hidden mt-6">
        <img src="{{ asset('images/files/106_rakhi_gold_jewellery__offer_hero_phone_-min5d78.jpg') }}"
             alt="Mobile Banner"
             class="w-full object-cover rounded-md shadow-md" />
    </div>
</section>

<!-- ======= Men's Jewellery Section ======= -->
<section class="py-14 bg-[#fffaf7]">
    <div class="max-w-7xl mx-auto px-4">
       <!-- Section Header with Filter -->
        <div class="flex justify-between items-center mb-8 flex-col sm:flex-row gap-4">
            <h2 class="text-3xl font-bold text-[#633d2e]">Men's Jewellery Collection</h2>
            <div class="flex items-center gap-2">
                <label for="categoryFilter" class="text-sm font-semibold text-[#633d2e]">Category:</label>
                <select id="categoryFilter" onchange="filterProducts()"
                    class="border border-[#e0c4ae] rounded-lg px-3 py-1.5 text-sm bg-white shadow-sm text-[#633d2e] focus:outline-none">
                    <option value="all" {{ request('category_id') == 'all' ? 'selected' : '' }}>All</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ request('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>


        <!-- Products Grid -->
        <div class="grid gap-6 grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4" id="productGrid">
            @forelse ($products as $product)
                <div class="block bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition relative group">

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

                    <!-- Image -->
                    <a href="{{ route('products.show', ['id' => Crypt::encrypt($product->id)]) }}">
                        <div class="relative">
                            <img src="{{ asset('storage/' . $product->image1) }}"
                                 data-hover="{{ $product->image2 ? asset('storage/' . $product->image2) : asset('storage/' . $product->image1) }}"
                                 class="h-full w-full aspect-[4/5] object-cover transition duration-500 group-hover:scale-[1.03]"
                                 onmouseover="this.src=this.dataset.hover;"
                                 onmouseout="this.src='{{ asset('storage/' . $product->image1) }}';"
                                 alt="{{ $product->name }}">
                        </div>
                    </a>

                    <!-- Product Info -->
                    <div class="p-4 text-center">
                        <h3 class="text-md font-semibold text-gray-800 truncate">{{ $product->name }}</h3>
                        <p class="text-[#d33f5f] font-bold text-lg">
                            ₹{{ number_format($product->price) }}
                            <span class="line-through text-sm text-gray-400 ml-1">
                                ₹{{ number_format($product->price + 1000) }}
                            </span>
                        </p>

                        <!-- Add to Cart -->
                        <button type="button"
                            class="add-to-cart-btn w-full bg-pink-100 hover:bg-pink-200 text-[#633d2e] font-semibold py-2 rounded-lg transition"
                            data-id="{{ $product->id }}">
                        Add to Cart
                    </button>
                    </div>
                </div>
            @empty
                <div id="comingSoon" class="text-center py-20 max-w-xl mx-auto">
                    <img src="{{ asset('images/coming-soon.png') }}" alt="Coming Soon"
                         class="mx-auto w-52 h-52 object-contain mb-6 opacity-90">
                    <h3 class="text-2xl font-bold text-[#633d2e] mb-2">Coming Soon</h3>
                    <p class="text-gray-600">We're working on adding more products in this category. Stay tuned!</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- ======= Scripts ======= -->
<script>
     function filterProducts() {
    let category = document.getElementById('categoryFilter').value;

    if (category === 'all') {
        window.location.href = "{{ route('category.mens.mens_jewellery') }}?category_id=all";
    } else {
        window.location.href = "{{ route('category.mens.mens_jewellery') }}?category_id=" + category;
    }
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

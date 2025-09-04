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
        <!-- Heading + Filters -->
        <div class="flex flex-col sm:flex-row items-center justify-between gap-4 mb-8">
            <h2 class="text-3xl font-bold text-[#633d2e]">Featured Products</h2>

            <!-- Filters -->
            <div class="flex flex-wrap items-center gap-4">
                <!-- Gender Filter -->
                <div class="flex items-center gap-2">
                    <label for="genderFilter" class="text-sm font-semibold text-[#633d2e]">Gender:</label>
                    <select id="genderFilter" onchange="applyFilters()"
                        class="border border-[#e0c4ae] rounded-lg px-3 py-1.5 text-sm bg-white shadow-sm text-[#633d2e] focus:outline-none">
                        <option value="all" {{ request('gender') == 'all' ? 'selected' : '' }}>All</option>
                        <option value="male" {{ request('gender') == 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ request('gender') == 'female' ? 'selected' : '' }}>Female</option>
                    </select>
                </div>

                <!-- Category Filter -->
                <div class="flex items-center gap-2">
                    <label for="categoryFilter" class="text-sm font-semibold text-[#633d2e]">Category:</label>
                    <select id="categoryFilter" onchange="applyFilters()"
                        class="border border-[#e0c4ae] rounded-lg px-3 py-1.5 text-sm bg-white shadow-sm text-[#633d2e] focus:outline-none">
                        <option value="all">All</option>
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

        <!-- Grid -->
        <div id="productGrid" class="grid gap-6 grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
            @foreach ($products as $product)
                @php
                    $discount =
                        isset($product->mrp) && $product->mrp > $product->price
                            ? round((($product->mrp - $product->price) / $product->mrp) * 100)
                            : 0;
                    $mrp = $product->mrp ?? $product->price + 1500;
                @endphp

                    <a href="{{ route('products.show', ['id' => Crypt::encrypt($product->id)]) }}">
                    class="group relative overflow-hidden rounded-2xl border border-white/30 bg-white/70 backdrop-blur-sm shadow-[0_6px_20px_rgba(99,61,46,0.08)] transition hover:-translate-y-1 hover:shadow-[0_12px_28px_rgba(99,61,46,0.15)] block">

                    <!-- Badges -->
                    <div class="absolute left-3 top-3 z-10 flex flex-col gap-2">
                        @if ($discount > 0)
                            <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-rose-100 text-rose-600">
                                -{{ $discount }}%
                            </span>
                        @endif
                        @if (($product->is_new ?? false) === true)
                            <span class="px-2.5 py-1 text-[11px] font-semibold rounded-full bg-emerald-100 text-emerald-700">
                                New
                            </span>
                        @endif
                    </div>

                    <!-- Wishlist -->
                    <button type="button"
                        class="absolute right-3 top-3 z-10 wishlist-btn {{ in_array($product->id, $wishlist ?? []) ? 'text-rose-600' : 'text-gray-400' }}"
                        data-id="{{ $product->id }}" title="Add to wishlist"
                        onclick="event.preventDefault(); event.stopPropagation();">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-5 w-5 fill-current">
                            <path
                                d="M12.1 21.35 10.6 20.03C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54l-1.35 1.31z" />
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

                    <!-- Info -->
                    <div class="p-4">
                        <h3 class="text-sm font-semibold text-gray-800 truncate" title="{{ $product->name }}">
                            {{ $product->name }}
                        </h3>

                        <!-- Price -->
                        <div class="mt-2 flex items-baseline gap-2">
                            <span class="text-lg font-bold text-[#d33f5f]">₹{{ number_format($product->price) }}</span>
                            <span class="text-sm text-gray-400 line-through">₹{{ number_format($mrp) }}</span>
                        </div>

                        <!-- Actions -->
                        <div class="mt-3 flex items-center gap-2">
                            <button
                                class="w-full rounded-xl bg-rose-100 px-3 py-2 text-sm font-semibold text-[#633d2e] hover:bg-rose-200 transition"
                                type="button">
                                Add to Cart
                            </button>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>

<!-- ======= Filter & Wishlist Script ======= -->
<script>
    function applyFilters() {
        let gender = document.getElementById('genderFilter').value;
        let category = document.getElementById('categoryFilter').value;
        let url = "{{ route('products.all') }}?";
        if (gender !== 'all') url += 'gender=' + gender + '&';
        if (category !== 'all') url += 'category_id=' + category;
        url = url.replace(/[&?]$/, '');
        window.location.href = url;
    }

    // Wishlist AJAX
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.wishlist-btn').forEach(button => {
            button.addEventListener('click', function (e) {
                e.preventDefault();
                e.stopPropagation(); // Prevent card link click

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
                        btn.classList.add('text-rose-600');
                    } else if (data.status === 'removed') {
                        btn.classList.remove('text-rose-600');
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
</script>
@endsection

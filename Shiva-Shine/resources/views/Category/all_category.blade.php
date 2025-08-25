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
            <!-- Heading + Filter -->
            <div class="flex flex-col sm:flex-row items-center justify-between gap-4 mb-8">
                <h2 class="text-3xl font-bold text-[#633d2e]">Featured Products</h2>

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

            <!-- Grid -->
            <div id="productGrid" class="grid gap-6 grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                @foreach ($products as $product)
                    @php
                        $category = $product->category ?? 'Uncategorized';
                        $discount =
                            isset($product->mrp) && $product->mrp > $product->price
                                ? round((($product->mrp - $product->price) / $product->mrp) * 100)
                                : 0;
                        $mrp = $product->mrp ?? $product->price + 1500;
                    @endphp

                    <div data-category="{{ $category }}"
                        class="group relative overflow-hidden rounded-2xl border border-white/30 bg-white/70 backdrop-blur-sm shadow-[0_6px_20px_rgba(99,61,46,0.08)] transition hover:-translate-y-1 hover:shadow-[0_12px_28px_rgba(99,61,46,0.15)]"
                        x-data="{ wished: false }">

                        <!-- Badges -->
                        <div class="absolute left-3 top-3 z-10 flex flex-col gap-2">
                            @if ($discount > 0)
                                <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-rose-100 text-rose-600">
                                    -{{ $discount }}%
                                </span>
                            @endif
                            @if (($product->is_new ?? false) === true)
                                <span
                                    class="px-2.5 py-1 text-[11px] font-semibold rounded-full bg-emerald-100 text-emerald-700">
                                    New
                                </span>
                            @endif
                        </div>

                        <!-- Wishlist -->
                        <button @click="wished = !wished" :aria-pressed="wished.toString()"
                            class="absolute right-3 top-3 z-10 grid h-9 w-9 place-items-center rounded-full bg-white/80 shadow hover:bg-white focus:outline-none"
                            title="Add to wishlist">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-5 w-5 transition"
                                :class="wished ? 'fill-rose-600' : 'fill-gray-400'">
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

                            <!-- Rating -->
                            <div class="mt-1 flex items-center gap-1.5 text-xs">
                                @php
                                    $rating = $product->rating ?? 4.8;
                                    $reviews = $product->reviews ?? 134;
                                @endphp
                                <div class="flex items-center">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @php $fill = $i <= floor($rating) ? 'fill-yellow-500' : ($i - $rating < 1 ? 'fill-yellow-500 opacity-50' : 'fill-gray-300'); @endphp
                                        <svg viewBox="0 0 24 24" class="h-4 w-4 {{ $fill }}">
                                            <path
                                                d="M12 .587 15.668 8.155 24 9.423l-6 5.845 1.416 8.232L12 18.896 4.584 23.5 6 15.268 0 9.423l8.332-1.268z" />
                                        </svg>
                                    @endfor
                                </div>
                                <span class="text-gray-600">({{ $reviews }})</span>
                            </div>

                            <!-- Price -->
                            <div class="mt-2 flex items-baseline gap-2">
                                <span class="text-lg font-bold text-[#d33f5f]">₹{{ number_format($product->price) }}</span>
                                <span class="text-sm text-gray-400 line-through">₹{{ number_format($mrp) }}</span>
                            </div>

                            <!-- Actions -->
                            <div class="mt-3 flex items-center gap-2">
                                <button
                                    class="w-full rounded-xl bg-rose-100 px-3 py-2 text-sm font-semibold text-[#633d2e] hover:bg-rose-200 transition">
                                    Add to Cart
                                </button>
                                <!-- Size/Variant hint (optional) -->
                                @if (!empty($product->variant_hint))
                                    <span
                                        class="shrink-0 rounded-lg border border-gray-200 px-2 py-1 text-xs text-gray-600">
                                        {{ $product->variant_hint }}
                                    </span>
                                @endif
                            </div>
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
            const cards = document.querySelectorAll('#productGrid [data-category]');
            cards.forEach(card => {
                const show = selected === 'all' || card.dataset.category === selected;
                card.style.display = show ? '' : 'none';
            });
        }
    </script>
@endsection

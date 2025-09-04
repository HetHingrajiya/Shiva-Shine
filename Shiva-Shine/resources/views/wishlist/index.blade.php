@extends('layouts.app')

@section('content')
<section class="py-20 bg-[#fffaf7] mt-16">
    <div class="max-w-7xl mx-auto px-4">

        <!-- Page Header -->
        <div class="flex justify-between items-center mb-10 flex-col sm:flex-row gap-4">
            <h2 class="text-3xl font-bold text-[#633d2e] flex items-center gap-2">
                💖 My Wishlist
            </h2>
            <a href="{{ route('products.all') }}"
               class="text-sm px-4 py-2 rounded-lg bg-[#633d2e] text-white hover:bg-[#4e2f23] transition duration-300">
               Continue Shopping
            </a>
        </div>

        <!-- Wishlist Grid -->
        <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
            @forelse ($wishlistItems as $item)
                @php $product = $item->product; @endphp

                <div class="wishlist-card bg-white rounded-2xl overflow-hidden shadow hover:shadow-lg transition relative group" data-id="{{ $product->id }}">

                    <!-- Heart Button -->
                    <button type="button"
                            class="absolute top-3 right-3 z-10 wishlist-btn text-red-500 transition"
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
                    <a href="{{ route('products.show', ['id' => $product->id]) }}">
                        <img src="{{ asset('storage/' . $product->image1) }}"
                             alt="{{ $product->name }}"
                             class="h-64 w-full object-cover transition duration-500 group-hover:scale-105">
                    </a>

                    <!-- Product Info -->
                    <div class="p-4 text-center">
                        <h3 class="text-md font-semibold text-gray-800 truncate">
                            {{ $product->name }}
                        </h3>

                        <p class="text-[#d33f5f] font-bold text-lg mt-2">
                            ₹{{ number_format($product->price) }}
                            <span class="line-through text-sm text-gray-400 ml-1">
                                ₹{{ number_format($product->price + 1000) }}
                            </span>
                        </p>

                        <a href="{{ route('products.show', ['id' => $product->id]) }}"
                           class="mt-4 block w-full bg-pink-100 hover:bg-pink-200 text-[#633d2e] font-semibold py-2 rounded-lg transition duration-300">
                            View Product
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-20">
                    <img src="{{ asset('images/empty-wishlist.png') }}"
                         alt="Empty Wishlist"
                         class="mx-auto w-48 h-48 object-contain mb-6 opacity-90">
                    <h3 class="text-2xl font-bold text-[#633d2e] mb-2">Your Wishlist is Empty</h3>
                    <p class="text-gray-600 mb-6">Save items you love and view them anytime here 💖</p>
                    <a href="{{ route('products.all') }}"
                       class="px-6 py-2 bg-[#633d2e] text-white rounded-lg hover:bg-[#4e2f23] transition duration-300">
                        Browse Products
                    </a>
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- ======= Wishlist Toggle Script ======= -->
<script>
document.querySelectorAll('.wishlist-btn').forEach(button => {
    button.addEventListener('click', function(e){
        e.preventDefault();
        e.stopPropagation();

        let productId = this.dataset.id;
        let card = this.closest('.wishlist-card');
        let btn = this;

        fetch("{{ route('wishlist.toggle') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({ product_id: productId })
        })
        .then(res => res.json())
        .then(data => {
            if(data.status === 'removed'){
                // Remove card with fade-out
                card.classList.add('transition-opacity', 'opacity-0');
                setTimeout(()=> card.remove(), 300);
            }
        })
        .catch(err => console.error(err));
    });
});
</script>
@endsection

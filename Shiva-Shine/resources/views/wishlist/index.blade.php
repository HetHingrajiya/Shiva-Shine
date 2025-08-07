@extends('layouts.app')

@section('content')
<!-- ===== Wishlist Section ===== -->
<section class="w-full bg-[#fffaf7] py-12 min-h-screen mt-20">
    <div class="max-w-7xl mx-auto px-4 md:px-6 lg:px-8 mt-10">
        <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-8">My Wishlist</h2>

        {{-- Flash Message --}}
        @if(session('message'))
            <div id="flash-message" class="mb-6 px-4 py-3 bg-green-100 border border-green-400 text-green-700 rounded transition-opacity duration-500">
                {{ session('message') }}
            </div>
        @endif

        @php
            $wishlistItems = [
                [
                    'id' => 1,
                    'name' => 'Rose Gold Earrings',
                    'description' => 'Elegant rose gold earrings for special occasions.',
                    'price' => 999,
                    'image' => 'https://via.placeholder.com/400x250?text=Product+1',
                ],
                [
                    'id' => 2,
                    'name' => 'Silver Anklet',
                    'description' => 'Trendy silver anklet with a smooth finish.',
                    'price' => 799,
                    'image' => 'https://via.placeholder.com/400x250?text=Product+2',
                ],
                [
                    'id' => 3,
                    'name' => 'Classic Gold Chain',
                    'description' => 'A timeless gold chain that matches every outfit.',
                    'price' => 1199,
                    'image' => 'https://via.placeholder.com/400x250?text=Product+3',
                ],
                [
                    'id' => 4,
                    'name' => 'Diamond Pendant',
                    'description' => 'Shiny pendant with a sparkling diamond stone.',
                    'price' => 1599,
                    'image' => 'https://via.placeholder.com/400x250?text=Product+4',
                ],
                [
                    'id' => 5,
                    'name' => 'Pearl Bracelet',
                    'description' => 'Elegant bracelet with freshwater pearls.',
                    'price' => 899,
                    'image' => 'https://via.placeholder.com/400x250?text=Product+5',
                ],
                [
                    'id' => 6,
                    'name' => 'Gemstone Ring',
                    'description' => 'Colorful gemstone ring with a minimal look.',
                    'price' => 699,
                    'image' => 'https://via.placeholder.com/400x250?text=Product+6',
                ],
            ];
        @endphp

        @if(count($wishlistItems) > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($wishlistItems as $item)
                    <div class="border rounded-lg overflow-hidden bg-white shadow-sm hover:shadow-md transition">
                        <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <h3 class="text-lg font-semibold text-gray-900">{{ $item['name'] }}</h3>
                            <p class="text-sm text-gray-600 mb-2">{{ $item['description'] }}</p>
                            <div class="flex items-center justify-between mt-4">
                                <span class="text-pink-600 font-bold text-lg">₹{{ $item['price'] }}</span>
                                <div class="flex gap-2">
                                    <form method="POST" action="{{ route('wishlist.remove', $item['id']) }}" class="remove-form">
                                        @csrf
                                        <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium">Remove</button>
                                    </form>
                                    <form method="POST" action="{{ route('wishlist.addToCart', $item['id']) }}" class="add-to-cart-form">
                                        @csrf
                                        <button type="submit" class="text-green-600 hover:text-green-800 text-sm font-medium">Add to Cart</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-20">
                <img src="https://via.placeholder.com/200x200?text=Empty" alt="Empty Wishlist" class="mx-auto w-48 mb-6">
                <p class="text-lg text-gray-600">Your wishlist is empty.</p>
                <a href="#" class="mt-4 inline-block bg-pink-600 text-white px-6 py-2 rounded hover:bg-pink-700 transition">
                    Browse Products
                </a>
            </div>
        @endif
    </div>
</section>
@endsection

@section('scripts')
<script>
    // Confirm before removing an item
    document.querySelectorAll('.remove-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            if (confirm('Are you sure you want to remove this item from your wishlist?')) {
                form.submit();
            }
        });
    });

    // Confirm before adding to cart
    document.querySelectorAll('.add-to-cart-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            if (confirm('Do you want to add this item to your cart?')) {
                form.submit();
            }
        });
    });

    // Auto-hide flash message
    const flash = document.getElementById('flash-message');
    if (flash) {
        setTimeout(() => {
            flash.style.opacity = '0';
        }, 3000);
    }
</script>
@endsection

@extends('layouts.app')

@section('content')
<!-- ===== Wishlist Section ===== -->
<section class="w-full bg-[#fffaf7] py-12 min-h-screen mt-10"> {{-- <-- Added mt-20 here --}}
    <div class="max-w-7xl mx-auto px-4">
        <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-8">My Wishlist</h2>

        @if(true) {{-- Replace with count($wishlistItems) > 0 in real logic --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @for($i = 0; $i < 6; $i++)
                    <div class="border rounded-lg overflow-hidden bg-white shadow-sm hover:shadow-md transition">
                        <img src="https://via.placeholder.com/400x250" alt="Product Image" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <h3 class="text-lg font-semibold text-gray-900">Product Name {{ $i+1 }}</h3>
                            <p class="text-sm text-gray-600 mb-2">This is a short description of the product. Highlight features or benefits here.</p>
                            <div class="flex items-center justify-between mt-4">
                                <span class="text-pink-600 font-bold text-lg">₹999</span>
                                <div class="flex gap-2">
                                    <form method="POST" action="#">
                                        @csrf
                                        <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium">Remove</button>
                                    </form>
                                    <form method="POST" action="#">
                                        @csrf
                                        <button type="submit" class="text-green-600 hover:text-green-800 text-sm font-medium">Add to Cart</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endfor
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

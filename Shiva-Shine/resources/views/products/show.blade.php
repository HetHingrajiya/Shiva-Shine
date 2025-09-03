@extends('layouts.app')

@section('content')

    <!-- Container -->
    <div class="max-w-6xl mx-auto px-4 py-24">

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">

            <!-- Left: Product Images -->
            <div class="flex flex-col gap-4">
                <div class="rounded-3xl overflow-hidden shadow-lg border border-gray-200">
                    <img id="mainImage" src="{{ asset('storage/' . $product->image1) }}" alt="{{ $product->name }}"
                        class="w-full h-[500px] object-cover">
                </div>
                <div class="flex gap-3 justify-center">
                    @foreach (['image1', 'image2', 'image3', 'image4', 'image5'] as $img)
                        @if (!empty($product->$img))
                            <img src="{{ asset('storage/' . $product->$img) }}"
                                onclick="document.getElementById('mainImage').src=this.src"
                                class="w-20 h-20 object-cover rounded-lg cursor-pointer border-2 border-transparent hover:border-pink-500 transition">
                        @endif
                    @endforeach
                </div>
            </div>

            <!-- Right: Product Info -->
            <div class="flex flex-col justify-start space-y-6">

                <!-- Product Name -->
                <h1 class="text-4xl font-extrabold text-gray-900">{{ $product->name }}</h1>

                <!-- Price -->
                <div class="flex items-center gap-4">
                    <span class="text-3xl font-bold text-pink-600">₹{{ number_format($product->price) }}</span>
                    <span class="line-through text-gray-400">₹{{ number_format($product->price + 1000) }}</span>
                </div>

                <!-- Short Description -->
                @if ($product->short_description)
                    <p class="text-gray-700 text-lg">{{ $product->short_description }}</p>
                @endif

                <!-- Add to Cart / Wishlist Buttons -->
                <div class="flex flex-col sm:flex-row gap-4">
                    <button
                        class="flex-1 bg-pink-600 hover:bg-pink-700 text-white font-semibold py-3 rounded-xl shadow-lg transition">
                        🛒 Add to Cart
                    </button>
                    <button
                        class="flex-1 border border-pink-600 text-pink-600 hover:bg-pink-50 font-semibold py-3 rounded-xl transition">
                        ♥ Wishlist
                    </button>
                </div>

                <!-- Long Description -->
                @if (!empty($product->description))
                    @php
                        // Split into intro + features + usage
                        $intro = $product->description;
                        $features = [];
                        $usage = '';

                        if (str_contains($product->description, '✨ Features:')) {
                            [$intro, $rest] = explode('✨ Features:', $product->description, 2);
                            $parts = explode('Whether you', $rest, 2);

                            $featureText = $parts[0] ?? '';
                            $usage = isset($parts[1]) ? 'Whether you' . $parts[1] : '';

                            $features = array_filter(array_map('trim', explode('-', $featureText)));
                        }
                    @endphp

                    <div class="mt-8 bg-white p-6 rounded-xl shadow border border-gray-200">
                        <h2 class="text-2xl font-bold text-gray-800 mb-4">Product Details</h2>

                        <!-- Intro Paragraph -->
                        @if ($intro)
                            <p class="text-gray-700 leading-relaxed mb-4">{{ trim($intro) }}</p>
                        @endif

                        <!-- Features List -->
                        @if (count($features))
                            <ul class="list-disc list-inside space-y-2 text-gray-700 mb-4">
                                @foreach ($features as $feature)
                                    <li>{{ $feature }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <!-- Usage -->
                        @if ($usage)
                            <p class="text-gray-700 leading-relaxed">{{ trim($usage) }}</p>
                        @endif
                    </div>
                @endif

            </div>
        </div>
    </div>
@endsection

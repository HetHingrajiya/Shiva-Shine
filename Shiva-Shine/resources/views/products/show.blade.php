@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-3 sm:px-6 py-36 sm:py-32 lg:py-36">

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-20">

            <!-- Left: Product Images -->
            <div class="space-y-4 sm:space-y-6">
                <!-- Main Image with Zoom -->
                <div class="relative rounded-2xl sm:rounded-3xl overflow-hidden shadow-xl border border-gray-200">
                    <div id="imgContainer" class="relative overflow-hidden cursor-zoom-in">
                        <img id="mainImage"
                             src="{{ asset('storage/' . $product->image1) }}"
                             alt="{{ $product->name }}"
                             class="w-full h-[380px] sm:h-[480px] lg:h-[550px] object-cover transition duration-300">
                    </div>
                </div>

                <!-- Thumbnails -->
                <div class="flex gap-3 sm:gap-4 justify-center flex-wrap">
                    @foreach (['image1', 'image2', 'image3', 'image4', 'image5'] as $img)
                        @if (!empty($product->$img))
                            <div class="relative group">
                                <img src="{{ asset('storage/' . $product->$img) }}"
                                     onclick="document.getElementById('mainImage').src=this.src"
                                     class="w-20 h-20 sm:w-24 sm:h-24 rounded-xl sm:rounded-2xl object-cover cursor-pointer border-2 border-transparent group-hover:border-pink-500 transition">
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>

            <!-- Right: Product Info -->
            <div class="flex flex-col space-y-8 sm:space-y-10">

                <!-- Product Title -->
                <h1 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-gray-900 tracking-tight leading-snug">
                    {{ $product->name }}
                </h1>

                <!-- Price & Offer -->
                <div class="flex items-center flex-wrap gap-3 sm:gap-5">
                    <span class="text-2xl sm:text-3xl font-bold text-pink-600">₹{{ number_format($product->price) }}</span>
                    <span class="line-through text-gray-400 text-base sm:text-lg">
                        ₹{{ number_format($product->price + 1000) }}
                    </span>
                    <span class="bg-green-100 text-green-700 text-xs sm:text-sm font-medium px-2.5 py-1 rounded-full">
                        Save ₹1000
                    </span>
                </div>

                <!-- Short Description -->
                @if ($product->short_description)
                    <p class="text-gray-600 text-base sm:text-lg leading-relaxed">
                        {{ $product->short_description }}
                    </p>
                @endif

                <!-- Action Buttons (Sticky on Mobile) -->
                <div
                    class="sticky bottom-0 bg-white/90 backdrop-blur-md p-3 sm:p-4 rounded-xl sm:rounded-2xl shadow-lg flex flex-col sm:flex-row gap-3 sm:gap-4 z-20">
                    <button
                        class="flex-1 bg-pink-600 hover:bg-pink-700 text-white text-base sm:text-lg font-semibold py-3 sm:py-4 rounded-lg sm:rounded-xl shadow-md transition">
                        🛒 Add to Cart
                    </button>
                    <button
                        class="flex-1 border border-pink-600 text-pink-600 hover:bg-pink-50 text-base sm:text-lg font-semibold py-3 sm:py-4 rounded-lg sm:rounded-xl transition">
                        ♥ Wishlist
                    </button>
                </div>

                <!-- Long Description -->
                @if (!empty($product->description))
                    @php
                        $intro = $product->description;
                        $features = [];
                        $usage = '';

                        if (str_contains($product->description, ' Features:')) {
                            [$intro, $rest] = explode(' Features:', $product->description, 2);
                            $parts = explode('Whether you', $rest, 2);
                            $featureText = $parts[0] ?? '';
                            $usage = isset($parts[1]) ? 'Whether you' . $parts[1] : '';
                            $features = array_filter(array_map('trim', explode('-', $featureText)));
                        }
                    @endphp

                    <!-- Modern Product Details Section -->
                    <div
                        class="mt-12 sm:mt-16 bg-gradient-to-br from-rose-50 to-white p-6 sm:p-10 rounded-2xl sm:rounded-3xl shadow-lg border border-gray-200 space-y-10">

                        <!-- Section Heading -->
                        <div>
                            <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-2">Product Description</h2>
                            <div class="h-1 w-16 bg-pink-400 rounded"></div>
                        </div>

                        <!-- Intro -->
                        @if ($intro)
                            <p class="text-gray-700 text-base sm:text-lg leading-relaxed">
                                {{ trim($intro) }}
                            </p>
                        @endif

                        <!-- Features -->
                        @if (count($features))
                            <div class="space-y-4">
                                <h3 class="text-lg sm:text-xl font-semibold text-gray-800 flex items-center gap-2">
                                    <span class="text-pink-500">✨</span> Key Features
                                </h3>
                                <ul class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    @foreach ($features as $feature)
                                        <li
                                            class="flex items-start gap-3 bg-white rounded-xl shadow-sm border border-gray-100 p-4 hover:shadow-md transition">
                                            <span class="text-pink-500 mt-1">✔</span>
                                            <span class="text-gray-700 text-sm sm:text-base">{{ $feature }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Usage -->
                        @if ($usage)
                            <div class="space-y-3">
                                <h3 class="text-lg sm:text-xl font-semibold text-gray-800 flex items-center gap-2">
                                    <span class="text-pink-500">💡</span> How to Use
                                </h3>
                                <p
                                    class="text-gray-700 text-sm sm:text-base leading-relaxed bg-white rounded-xl p-5 border border-gray-100 shadow-sm">
                                    {{ trim($usage) }}
                                </p>
                            </div>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Image Zoom Script -->
    <script>
        const imgContainer = document.getElementById("imgContainer");
        const mainImage = document.getElementById("mainImage");

        imgContainer.addEventListener("mousemove", function (e) {
            const { left, top, width, height } = imgContainer.getBoundingClientRect();
            const x = ((e.pageX - left) / width) * 100;
            const y = ((e.pageY - top) / height) * 100;

            mainImage.style.transformOrigin = `${x}% ${y}%`;
            mainImage.style.transform = "scale(2)"; // zoom 2x
        });

        imgContainer.addEventListener("mouseleave", function () {
            mainImage.style.transformOrigin = "center center";
            mainImage.style.transform = "scale(1)";
        });
    </script>
@endsection

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }} - Product Details</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen relative">

    <!-- Back Button (Floating Top Left) -->
    <a href="{{ url()->previous() }}"
       class="fixed top-6 left-6 z-50 inline-flex items-center gap-2 px-5 py-2.5 bg-white border border-gray-300 rounded-full shadow-lg hover:shadow-2xl hover:bg-gray-100 text-gray-700 font-medium transition">
        ← Back
    </a>

    <!-- Container -->
    <div class="max-w-6xl mx-auto px-4 py-24">

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">

            <!-- Left: Product Images -->
            <div class="flex flex-col gap-4">
                <div class="rounded-3xl overflow-hidden shadow-lg border border-gray-200">
                    <img id="mainImage" src="{{ asset('storage/' . $product->image1) }}"
                         alt="{{ $product->name }}" class="w-full h-[500px] object-cover">
                </div>
                <div class="flex gap-3 justify-center">
                    @foreach(['image1','image2','image3','image4','image5'] as $img)
                        @if($product->$img)
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
                <p class="text-gray-700 text-lg">{{ $product->short_description }}</p>

                <!-- Add to Cart / Wishlist Buttons -->
                <div class="flex flex-col sm:flex-row gap-4">
                    <button class="flex-1 bg-pink-600 hover:bg-pink-700 text-white font-semibold py-3 rounded-xl shadow-lg transition">
                        🛒 Add to Cart
                    </button>
                    <button class="flex-1 border border-pink-600 text-pink-600 hover:bg-pink-50 font-semibold py-3 rounded-xl transition">
                        ♥ Wishlist
                    </button>
                </div>

                <!-- Long Description -->
                <div class="mt-8 bg-white p-6 rounded-xl shadow border border-gray-200">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Product Details</h2>

                    @php
                        $description = $product->description;
                        $parts = explode('✨ Features:', $description);
                        $intro = $parts[0] ?? '';
                        $features_text = $parts[1] ?? '';
                        $features_and_usage = explode('Whether you', $features_text);
                        $features = $features_and_usage[0] ?? '';
                        $usage = isset($features_and_usage[1]) ? 'Whether you' . $features_and_usage[1] : '';
                        $feature_list = array_filter(array_map('trim', explode('-', $features)));
                    @endphp

                    <!-- Intro Paragraph -->
                    @if($intro)
                        <p class="text-gray-700 leading-relaxed mb-4">{{ $intro }}</p>
                    @endif

                    <!-- Features List -->
                    @if(count($feature_list))
                        <ul class="list-disc list-inside space-y-2 text-gray-700 mb-4">
                            @foreach($feature_list as $feature)
                                <li>{{ $feature }}</li>
                            @endforeach
                        </ul>
                    @endif

                    <!-- Usage / Gift Paragraph -->
                    @if($usage)
                        <p class="text-gray-700 leading-relaxed">{{ $usage }}</p>
                    @endif
                </div>

            </div>
        </div>
    </div>

</body>
</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Shiva Shine</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Alpine.js -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <!-- Hide Scrollbar -->
    <style>
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }

        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</head>

<body>

    {{-- Navbar --}}
    @include('components.navbar')
    <section class="pt-20">
        <!-- ===== Desktop Slideshow ===== -->
        <div class="relative w-full overflow-hidden hidden md:block mt-10">
            <div id="desktopSlideshow" class="flex transition-transform duration-700 ease-in-out">
                <img src="{{ asset('images/files/106_rakhi_gold_jewellery__offer_hero_web-minda97.jpg') }}"
                    class="w-full h-[550px] object-cover flex-shrink-0" alt="Banner 1">
                <img src="{{ asset('images/files/58_silver_jewellery_offer_hero_web_1_-mind2de.jpg') }}"
                    class="w-full h-[550px] object-cover flex-shrink-0" alt="Banner 2">
                <img src="{{ asset('images/files/35-Personalised_Rakhi_Hero_Web-min7bb2.jpg') }}"
                    class="w-full h-[550px] object-cover flex-shrink-0" alt="Banner 3">
            </div>

            <!-- Arrows -->
            <button id="prevDesktopSlide"
                class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-white/20 p-2 rounded-full shadow z-10">
                <svg class="w-6 h-6 text-white/70" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path d="M15 19l-7-7 7-7" />
                </svg>
            </button>
            <button id="nextDesktopSlide"
                class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-white/20 p-2 rounded-full shadow z-10">
                <svg class="w-6 h-6 text-white/70" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path d="M9 5l7 7-7 7" />
                </svg>
            </button>
        </div>

        <!-- ===== Mobile Slideshow ===== -->
        <div class="relative w-full overflow-hidden md:hidden px-4 mt-10">
            <div id="mobileSlideshow" class="flex transition-transform duration-700 ease-in-out">
                <img src="{{ asset('images/files/106_rakhi_gold_jewellery__offer_hero_phone_-min5d78.jpg') }}"
                    class="w-full rounded shadow-md flex-shrink-0" alt="Mobile Banner 1">
                <img src="{{ asset('images/files/58_silver_jewellery_offer_hero_phone_1_-min02f3.jpg') }}"
                    class="w-full rounded shadow-md flex-shrink-0" alt="Mobile Banner 2">
                <img src="{{ asset('images/files/35-Personalised_Rakhi_Hero_Phone-minc113.jpg') }}"
                    class="w-full rounded shadow-md flex-shrink-0" alt="Mobile Banner 3">
            </div>

            <!-- Arrows -->
            <button id="prevMobileSlide"
                class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-white p-2 rounded-full shadow z-10">
                <svg class="w-6 h-6 text-pink-500" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path d="M15 19l-7-7 7-7" />
                </svg>
            </button>
            <button id="nextMobileSlide"
                class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-white p-2 rounded-full shadow z-10">
                <svg class="w-6 h-6 text-pink-500" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path d="M9 5l7 7-7 7" />
                </svg>
            </button>
        </div>

        <!-- ===== Circular Category Slider Section ===== -->
        <div class="px-4 mt-10 relative">
            <!-- Left Arrow -->
            <button onclick="scrollSlider('left')"
                class="absolute left-2 top-1/2 transform -translate-y-1/2 bg-white hover:bg-pink-100 text-pink-400 rounded-full p-2 shadow-md z-10">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>

            <!-- Scrollable Slider -->
            <div class="px-4 md:px-6">
                <div id="category-slider"
                    class="flex space-x-1 md:space-x-6 overflow-x-auto scrollbar-hide py-4 scroll-smooth">
                    @foreach ([['label' => 'Personalised', 'src' => 'images/files/8_5c398.jpg'], ['label' => 'Earrings', 'src' => 'images/files/ER0584_3f06c.jpg'], ['label' => 'Bracelet', 'src' => 'images/files/BR01176_5cc57.jpg'], ['label' => 'Rings', 'src' => 'images/files/GDLBBR012_56e78.jpg'], ['label' => 'Earrings', 'src' => 'images/files/ER0584_3f06c.jpg'], ['label' => 'Bracelet', 'src' => 'images/files/BR01176_5cc57.jpg'], ['label' => 'Rings', 'src' => 'images/files/GDLBBR012_56e78.jpg'], ['label' => 'Earrings', 'src' => 'images/files/ER0584_3f06c.jpg'], ['label' => 'Bracelet', 'src' => 'images/files/BR01176_5cc57.jpg'], ['label' => 'Rings', 'src' => 'images/files/GDLBBR012_56e78.jpg']] as $item)
                        <div class="flex flex-col items-center min-w-[110px] md:min-w-[220px]">
                            <div
                                class="w-[90px] h-[90px] md:w-[200px] md:h-[200px] flex items-center justify-center hover:scale-105 transition-transform border border-[#D4AF37] rounded-[40px] md:rounded-[80px]">
                                <img src="{{ asset($item['src']) }}" alt="{{ $item['label'] }}"
                                    class="object-cover w-full h-full rounded-[39px] md:rounded-[79px]" />
                            </div>
                            <span class="mt-1 text-xl md:text-2xl font-medium text-gray-800 text-center">
                                {{ $item['label'] }}
                            </span>

                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Right Arrow -->
            <button onclick="scrollSlider('right')"
                class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-white hover:bg-pink-100 text-pink-400 rounded-full p-2 shadow-md z-10">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>
        </div>


        <!-- ===== Shop by Recipient Section ===== -->
        <section class="py-4 bg-white mt-4">
            <h2 class="text-center text-3xl md:text-4xl font-semibold text-[#633d2e] mb-10">
                Shop by Recipient
            </h2>

            <div class="max-w-7xl mx-auto px-4">
                <div class="flex justify-center items-center flex-wrap md:flex-nowrap gap-4 md:gap-10">

                    <!-- Him -->
                    <div class="w-1/2 max-w-[160px] md:max-w-none md:w-1/2">
                        <div
                            class="overflow-hidden rounded-xl transition-transform duration-300 hover:scale-105 hover:lg">
                            <img src="{{ asset('images/files/him_4_-min_9a1111cf-2eb7-4f4f-af34-fd85f064584c2034.jpg') }}"
                                alt="Him" class="w-full h-auto object-cover">
                        </div>
                    </div>

                    <!-- Her -->
                    <div class="w-1/2 max-w-[160px] md:max-w-none md:w-1/2">
                        <div
                            class="overflow-hidden rounded-xl transition-transform duration-300 hover:scale-105 hover:lg">
                            <img src="{{ asset('images/files/her_1_-min_68668776-8dc0-4f43-a333-a630a36fddee2034.jpg') }}"
                                alt="Her" class="w-full h-auto object-cover">
                        </div>
                    </div>

                </div>
            </div>
        </section>


        <!-- ===== For Partners in Crime Section ===== -->
        <section class="px-4 py-5 bg-gradient-to-br from-pink-100 via-rose-50 to-orange-80">
            <h2 class="text-2xl md:text-3xl font-semibold text-center text-[#633d2e] mb-6">
                For Partners in Crime
            </h2>

            @php
                $products = [
                    [
                        'name' => 'His & Her Rings',
                        'price' => 2499,
                        'category' => 'Rings',
                        'image' => 'images/files/Untitled-1.jpg',
                    ],
                    [
                        'name' => 'Couple Bracelets',
                        'price' => 2999,
                        'category' => 'Bracelet',
                        'image' => 'images/files/Untitled-1.jpg',
                    ],
                    [
                        'name' => 'Lock & Key Pendants',
                        'price' => 3199,
                        'category' => 'Pendant',
                        'image' => 'images/files/Untitled-1.jpg',
                    ],
                    [
                        'name' => 'Name Engraved Rings',
                        'price' => 2799,
                        'category' => 'Rings',
                        'image' => 'images/files/Untitled-1.jpg',
                    ],
                    [
                        'name' => 'His & Her Rings',
                        'price' => 2499,
                        'category' => 'Rings',
                        'image' => 'images/files/Untitled-1.jpg',
                    ],
                    [
                        'name' => 'Couple Bracelets',
                        'price' => 2999,
                        'category' => 'Bracelet',
                        'image' => 'images/files/Untitled-1.jpg',
                    ],
                    [
                        'name' => 'Name Engraved Rings',
                        'price' => 2799,
                        'category' => 'Rings',
                        'image' => 'images/files/Untitled-1.jpg',
                    ],
                    [
                        'name' => 'Lock & Key Pendants',
                        'price' => 3199,
                        'category' => 'Pendant',
                        'image' => 'images/files/Untitled-1.jpg',
                    ],
                ];
            @endphp

            <div class="relative">
                <!-- Scroll Buttons -->
                <button onclick="scrollProduct('left')"
                    class="absolute left-0 top-1/2 transform -translate-y-1/2 z-10 bg-white shadow p-2 rounded-full">
                    <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M15 19l-7-7 7-7" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                    </svg>
                </button>
                <button onclick="scrollProduct('right')"
                    class="absolute right-0 top-1/2 transform -translate-y-1/2 z-10 bg-white shadow p-2 rounded-full">
                    <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M9 5l7 7-7 7" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                    </svg>
                </button>

                <!-- Scrollable Product Cards -->
                <div id="product-scroll" class="flex overflow-x-auto gap-4 scrollbar-hide scroll-smooth px-2 py-6">
                    @foreach ($products as $product)
                        <div
                            class="w-[calc(50vw-2rem)] sm:w-[200px] md:w-[300px] flex-shrink-0 bg-white border border-gray-200 rounded-xl p-4 shadow transition duration-300 relative flex flex-col justify-between">
                            <!-- Image Wrapper with group -->
                            <div class="relative group">
                                <!-- Product Image -->
                                <img src="{{ asset($product['image']) }}" alt="{{ $product['name'] }}"
                                    class="w-full h-full object-cover rounded-lg mb-4 shadow-sm transition-transform duration-300 group-hover:scale-105">

                                <!-- Wishlist Icon (only visible on image hover) -->
                                <button
                                    class="absolute top-2 right-2 text-gray-400 opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none group-hover:pointer-events-auto">
                                    <svg class="w-6 h-6 fill-current hover:text-pink-500 transition-colors duration-200"
                                        viewBox="0 0 24 24">
                                        <path
                                            d="M12.1 8.64l-.1.1-.11-.1C10.14 6.86 7.5 7.22 6.15 9.04c-1.32 1.75-.96 4.32.99 6.29L12 21.35l4.86-6.01c1.94-1.97 2.31-4.54.99-6.29-1.35-1.82-3.99-2.18-5.75-.41z" />
                                    </svg>
                                </button>
                            </div>

                            <!-- Product Details -->
                            <div class="text-sm text-gray-600 mb-1">{{ $product['category'] }}</div>
                            <h3 class="font-semibold text-base text-gray-800 mb-1 hover:text-pink-600">
                                {{ $product['name'] }}</h3>

                            <div class="flex items-center gap-2 mb-1">
                                <span class="text-pink-600 font-bold text-base">₹{{ $product['price'] }}</span>
                                <span
                                    class="line-through text-gray-400 text-sm">₹{{ $product['price'] + 1000 }}</span>
                            </div>

                            <div class="flex items-center mb-2">
                                <span class="text-yellow-400 text-sm">★ 4.8</span>
                                <span class="text-sm text-gray-400 ml-2">(100+)</span>
                            </div>

                            <button
                                class="w-full bg-pink-100 hover:bg-pink-200 text-pink-600 font-semibold py-2 rounded-lg transition duration-200">
                                Add to Cart
                            </button>
                        </div>
                    @endforeach
                </div>

            </div>
        </section>

        <!-- ===== Men's Collection ===== -->
        <section class="bg-white py-10">
            <div class="w-full">
                <h2 class="text-center text-3xl md:text-4xl font-semibold text-[#633d2e] mb-2">
                    Men's Collection
                </h2>
                <p class="text-center text-gray-500 mb-10 text-lg">Jewellery That Defines Him</p>

                @php
                    $mensCards = [
                        ['title' => 'Work Picks', 'image' => 'images/files/Men_5-min2876.png'],
                        ['title' => 'Party Picks', 'image' => 'images/files/Men1-1-minebc4.jpg'],
                        ['title' => 'Spiritual Picks', 'image' => 'images/files/Men2-min2876.png'],
                        ['title' => 'Daily Picks', 'image' => 'images/files/Men3-min2876.png'],
                        ['title' => 'Wedding Picks', 'image' => 'images/files/Men4-min2876.png'],
                    ];
                @endphp

                <!-- Scrollable Container -->
                <div class="overflow-x-auto scrollbar-hide scroll-smooth px-2 sm:px-4">
                    <div class="flex gap-4 sm:gap-6 md:gap-8 w-max py-2">
                        @foreach ($mensCards as $card)
                            <div
                                class="w-[calc(53vw-2rem)] sm:w-[auto] md:w-[340px] flex-shrink-0 bg-white rounded-xl relative flex flex-col justify-between">
                                <div class="w-full h-[auto] sm:h-[auto] md:h-[auto] overflow-hidden rounded-lg">
                                    <img src="{{ asset($card['image']) }}" alt="{{ $card['title'] }}"
                                        class="w-full h-full object-cover object-center" />
                                </div>
                                {{-- <h3 class="text-center text-lg font-medium text-[#633d2e]">{{ $card['title'] }}</h3> --}}
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>



            <!-- ===== Women's Collection ===== -->
            <section class="bg-white py-10">
                <div class="w-full">
                    <h2 class="text-center text-3xl md:text-4xl font-semibold text-[#633d2e] mb-2">
                        Women's Collection
                    </h2>
                    <p class="text-center text-gray-500 mb-10 text-lg">Jewellery That Defines Him</p>

                    @php
                        $mensCards = [
                            ['title' => 'Work Picks', 'image' => 'images/files/Men_5-min2876.png'],
                            ['title' => 'Party Picks', 'image' => 'images/files/Men1-1-minebc4.jpg'],
                            ['title' => 'Spiritual Picks', 'image' => 'images/files/Men2-min2876.png'],
                            ['title' => 'Daily Picks', 'image' => 'images/files/Men3-min2876.png'],
                            ['title' => 'Wedding Picks', 'image' => 'images/files/Men4-min2876.png'],
                        ];
                    @endphp

                    <!-- Scrollable Container -->
                    <div class="overflow-x-auto scrollbar-hide scroll-smooth px-2 sm:px-4">
                        <div class="flex gap-4 sm:gap-6 md:gap-10 w-max py-2">
                            @foreach ($mensCards as $card)
                                <div
                                    class="w-[calc(53vw-2rem)] sm:w-[auto] md:w-[340px] flex-shrink-0 bg-white rounded-xl   transition duration-300 relative flex flex-col justify-between">
                                    <img src="{{ asset($card['image']) }}" alt="{{ $card['title'] }}"
                                        class="w-full h-full object-cover object-center" />
                                </div>
                            @endforeach
                        </div>
                    </div>


                </div>
            </section>


        <!-- =====Most Gifted Section ===== -->
        <section class="px-4 py-5 bg-gradient-to-br from-pink-100 via-rose-50 to-orange-80">
            <h2 class="text-2xl md:text-3xl font-semibold text-center text-[#633d2e] mb-6">
                Most Gifted
            </h2>

            @php
                $products = [
                    [
                        'name' => 'His & Her Rings',
                        'price' => 2499,
                        'category' => 'Rings',
                        'image' => 'images/files/Untitled-1.jpg',
                    ],
                    [
                        'name' => 'Couple Bracelets',
                        'price' => 2999,
                        'category' => 'Bracelet',
                        'image' => 'images/files/Untitled-1.jpg',
                    ],
                    [
                        'name' => 'Lock & Key Pendants',
                        'price' => 3199,
                        'category' => 'Pendant',
                        'image' => 'images/files/Untitled-1.jpg',
                    ],
                    [
                        'name' => 'Name Engraved Rings',
                        'price' => 2799,
                        'category' => 'Rings',
                        'image' => 'images/files/Untitled-1.jpg',
                    ],
                    [
                        'name' => 'His & Her Rings',
                        'price' => 2499,
                        'category' => 'Rings',
                        'image' => 'images/files/Untitled-1.jpg',
                    ],
                    [
                        'name' => 'Couple Bracelets',
                        'price' => 2999,
                        'category' => 'Bracelet',
                        'image' => 'images/files/Untitled-1.jpg',
                    ],
                    [
                        'name' => 'Name Engraved Rings',
                        'price' => 2799,
                        'category' => 'Rings',
                        'image' => 'images/files/Untitled-1.jpg',
                    ],
                    [
                        'name' => 'Lock & Key Pendants',
                        'price' => 3199,
                        'category' => 'Pendant',
                        'image' => 'images/files/Untitled-1.jpg',
                    ],
                ];
            @endphp

            <div class="relative">
                <!-- Scroll Buttons -->
                <button onclick="scrollProduct('left')"
                    class="absolute left-0 top-1/2 transform -translate-y-1/2 z-10 bg-white shadow p-2 rounded-full">
                    <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M15 19l-7-7 7-7" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                    </svg>
                </button>
                <button onclick="scrollProduct('right')"
                    class="absolute right-0 top-1/2 transform -translate-y-1/2 z-10 bg-white shadow p-2 rounded-full">
                    <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M9 5l7 7-7 7" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                    </svg>
                </button>

                <!-- Scrollable Product Cards -->
                <div id="product-scroll" class="flex overflow-x-auto gap-4 scrollbar-hide scroll-smooth px-2 py-6">
                    @foreach ($products as $product)
                        <div
                            class="w-[calc(50vw-2rem)] sm:w-[200px] md:w-[300px] flex-shrink-0 bg-white border border-gray-200 rounded-xl p-4 shadow transition duration-300 relative flex flex-col justify-between">

                            <!-- Image Wrapper with group -->
                            <div class="relative group">
                                <!-- Product Image -->
                                <img src="{{ asset($product['image']) }}" alt="{{ $product['name'] }}"
                                    class="w-full h-full object-cover rounded-lg mb-4 shadow-sm transition-transform duration-300 group-hover:scale-105">

                                <!-- Wishlist Icon (only visible on image hover) -->
                                <button
                                    class="absolute top-2 right-2 text-gray-400 opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none group-hover:pointer-events-auto">
                                    <svg class="w-6 h-6 fill-current hover:text-pink-500 transition-colors duration-200"
                                        viewBox="0 0 24 24">
                                        <path
                                            d="M12.1 8.64l-.1.1-.11-.1C10.14 6.86 7.5 7.22 6.15 9.04c-1.32 1.75-.96 4.32.99 6.29L12 21.35l4.86-6.01c1.94-1.97 2.31-4.54.99-6.29-1.35-1.82-3.99-2.18-5.75-.41z" />
                                    </svg>
                                </button>
                            </div>

                            <!-- Product Details -->
                            <div class="text-sm text-gray-600 mb-1">{{ $product['category'] }}</div>
                            <h3 class="font-semibold text-base text-gray-800 mb-1 hover:text-pink-600">
                                {{ $product['name'] }}</h3>

                            <div class="flex items-center gap-2 mb-1">
                                <span class="text-pink-600 font-bold text-base">₹{{ $product['price'] }}</span>
                                <span
                                    class="line-through text-gray-400 text-sm">₹{{ $product['price'] + 1000 }}</span>
                            </div>

                            <div class="flex items-center mb-2">
                                <span class="text-yellow-400 text-sm">★ 4.8</span>
                                <span class="text-sm text-gray-400 ml-2">(100+)</span>
                            </div>

                            <button
                                class="w-full bg-pink-100 hover:bg-pink-200 text-pink-600 font-semibold py-2 rounded-lg transition duration-200">
                                Add to Cart
                            </button>
                        </div>
                    @endforeach
                </div>

            </div>
        </section>

        <!-- ===== Customer Stories/Reviews Section ===== -->
        <section class="py-16 bg-amber-50">
            <h2 class="text-3xl md:text-4xl font-bold text-center text-[#633d2e] mb-12">
              Customer Stories
            </h2>

            <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-8 px-4">
              <!-- Review Card 1 -->
              <div class="bg-yellow-100 rounded-2xl px-6 py-10 flex flex-col items-center text-center shadow-md transform transition duration-300 hover:-translate-y-2 hover:shadow-xl">
                <h3 class="font-semibold text-2xl mb-4 text-gray-800">Virda</h3>
                <p class="text-base text-gray-700 mb-6 leading-relaxed">
                  A big shout out to you guys for improving my hubby's gifting tastes. Completely in love with my ring!
                </p>
                <img src="{{ asset('images/files/review-1.jpg') }}" alt="Virda"
                  class="rounded-full w-20 h-20 object-cover border-4 border-white shadow-lg" />
              </div>

              <!-- Review Card 2 -->
              <div class="bg-yellow-100 rounded-2xl px-6 py-10 flex flex-col items-center text-center shadow-md transform transition duration-300 hover:-translate-y-2 hover:shadow-xl">
                <h3 class="font-semibold text-2xl mb-4 text-gray-800">Harshika</h3>
                <p class="text-base text-gray-700 mb-6 leading-relaxed">
                  Never thought buying jewellery would be this easy, thanks for helping make my mom's birthday special.
                </p>
                <img src="{{ asset('images/files/review-2.jpg') }}" alt="Harshika"
                  class="rounded-full w-20 h-20 object-cover border-4 border-white shadow-lg" />
              </div>

              <!-- Review Card 3 -->
              <div class="bg-yellow-100 rounded-2xl px-6 py-10 flex flex-col items-center text-center shadow-md transform transition duration-300 hover:-translate-y-2 hover:shadow-xl">
                <h3 class="font-semibold text-2xl mb-4 text-gray-800">Priya</h3>
                <p class="text-base text-gray-700 mb-6 leading-relaxed">
                  Gifted these earrings to my sister on her wedding and she loved them! I am obsessed with buying gifts from GIVA.
                </p>
                <img src="{{ asset('images/files/review-3.jpg') }}" alt="Priya"
                  class="rounded-full w-20 h-20 object-cover border-4 border-white shadow-lg" />
              </div>
            </div>
          </section>


        </div>
    </section>

    <!-- ===== Footer ===== -->
    @include('components.footer')

    </section>

    <!-- ===== Scripts ===== -->
    <script>
        // Slideshow logic (desktop)
        const desktopSlideshow = document.getElementById('desktopSlideshow');
        const desktopSlides = desktopSlideshow?.children || [];
        let desktopCurrent = 0;

        function showDesktopSlide(index) {
            desktopSlideshow.style.transform = `translateX(-${index * 100}%)`;
        }

        document.getElementById('prevDesktopSlide')?.addEventListener('click', () => {
            desktopCurrent = (desktopCurrent - 1 + desktopSlides.length) % desktopSlides.length;
            showDesktopSlide(desktopCurrent);
        });

        document.getElementById('nextDesktopSlide')?.addEventListener('click', () => {
            desktopCurrent = (desktopCurrent + 1) % desktopSlides.length;
            showDesktopSlide(desktopCurrent);
        });

        setInterval(() => {
            desktopCurrent = (desktopCurrent + 1) % desktopSlides.length;
            showDesktopSlide(desktopCurrent);
        }, 5000);
        showDesktopSlide(desktopCurrent);

        // Mobile slideshow logic
        const mobileSlideshow = document.getElementById('mobileSlideshow');
        const mobileSlides = mobileSlideshow?.children || [];
        let mobileCurrent = 0;

        function showMobileSlide(index) {
            mobileSlideshow.style.transform = `translateX(-${index * 100}%)`;
        }

        document.getElementById('prevMobileSlide')?.addEventListener('click', () => {
            mobileCurrent = (mobileCurrent - 1 + mobileSlides.length) % mobileSlides.length;
            showMobileSlide(mobileCurrent);
        });

        document.getElementById('nextMobileSlide')?.addEventListener('click', () => {
            mobileCurrent = (mobileCurrent + 1) % mobileSlides.length;
            showMobileSlide(mobileCurrent);
        });

        setInterval(() => {
            mobileCurrent = (mobileCurrent + 1) % mobileSlides.length;
            showMobileSlide(mobileCurrent);
        }, 5000);
        showMobileSlide(mobileCurrent);

        // Scrollable slider function
        function scrollSlider(direction) {
            const slider = document.getElementById("category-slider");
            const scrollAmount = 220;
            slider.scrollBy({
                left: direction === "left" ? -scrollAmount : scrollAmount,
                behavior: "smooth"
            });
        }

        // Scroll Script

        function scrollProduct(direction) {
            const container = document.getElementById('product-scroll');
            const scrollAmount = 300;
            container.scrollBy({
                left: direction === 'left' ? -scrollAmount : scrollAmount,
                behavior: 'smooth'
            });
        }
    </script>

</body>

</html>

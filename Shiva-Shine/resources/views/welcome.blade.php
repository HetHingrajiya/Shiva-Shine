@extends('layouts.app')
@section('content')


    <section class="pt-20  ">
        <!-- ===== Desktop Slideshow ===== -->
        <div class="relative w-full overflow-hidden hidden md:block mt-8">
            <div id="desktopSlideshow" class="flex transition-transform duration-700 ease-in-out">
                <img src="{{ asset('images/files/106_rakhi_gold_jewellery__offer_hero_web-minda97.jpg') }}"
                    class="w-full h-[550px] object-cover flex-shrink-0" alt="Banner 1">
                <img src="{{ asset('images/files/58_silver_jewellery_offer_hero_web_1_-mind2de.jpg') }}"
                    class="w-full h-[550px] object-cover flex-shrink-0" alt="Banner 2">
                <img src="{{ asset('images/files/35-Personalised_Rakhi_Hero_Web-min7bb2.jpg') }}"
                    class="w-full h-[550px] object-cover flex-shrink-0" alt="Banner 3">
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

        <!-- ===== Mobile Slideshow ===== -->
        <div class="relative w-full overflow-hidden md:hidden  mt-20">
            <div id="mobileSlideshow" class="flex transition-transform duration-700 ease-in-out">
                <img src="{{ asset('images/1.jpg') }}" class="w-full rounded shadow-md flex-shrink-0" alt="Mobile Banner 1">
                <img src="{{ asset('images/2.jpg') }}" class="w-full rounded shadow-md flex-shrink-0" alt="Mobile Banner 2">
                <img src="{{ asset('images/3.jpg') }}" class="w-full rounded shadow-md flex-shrink-0" alt="Mobile Banner 3">
                <img src="{{ asset('images/4.jpg') }}" class="w-full rounded shadow-md flex-shrink-0" alt="Mobile Banner 4">
                <img src="{{ asset('images/5.jpg') }}" class="w-full rounded shadow-md flex-shrink-0" alt="Mobile Banner 5">
                <img src="{{ asset('images/6.jpg') }}" class="w-full rounded shadow-md flex-shrink-0" alt="Mobile Banner 6">
            </div>

            <!-- Arrows -->
            <button id="prevMobileSlide"
                class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-white p-1 rounded-full shadow z-10">
                <svg class="w-4 h-4 text-pink-500" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path d="M15 19l-7-7 7-7" />
                </svg>
            </button>
            <button id="nextMobileSlide"
                class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-white p-1 rounded-full shadow z-10">
                <svg class="w-4 h-4 text-pink-500" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path d="M9 5l7 7-7 7" />
                </svg>
            </button>
        </div>

        <!-- ===== Circular Category Slider Section ===== -->
        <div class=" mt-8 relative">
            <!-- Left Arrow -->
            <button onclick="scrollSlider('left')"
                class="absolute left-2 top-1/2 transform -translate-y-1/2 bg-white hover:bg-pink-100 text-pink-400 rounded-full p-1 md:p-2 shadow-md z-10">
                <svg class="h-4 w-4 md:h-6 md:w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>



            <!-- Scrollable Slider -->

            <div id="category-slider" class="flex space-x-1 md:space-x-6 overflow-x-auto scrollbar-hide py-4 scroll-smooth">
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

            <!-- Right Arrow -->
            <button onclick="scrollSlider('right')"
                class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-white hover:bg-pink-100 text-pink-400 rounded-full p-1 md:p-2 shadow-md z-10">
                <svg class="h-4 w-4 md:h-6 md:w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>

        </div>


        <section class="py-4 bg-white mt-4">
            <h2 class="text-center text-3xl md:text-4xl font-semibold text-[#633d2e] mb-10">
                Shop by Recipient
            </h2>

            <div class="max-w-7xl mx-auto px-4">
                <div class="flex flex-row md:flex-row justify-center items-center gap-4 md:gap-10">
                    <!-- Him -->
                    <div class="w-full md:w-1/2">
                        <div class="overflow-hidden rounded-xl transition-transform duration-300 hover:scale-105">
                            <img src="{{ asset('images/files/him_4_-min_9a1111cf-2eb7-4f4f-af34-fd85f064584c2034.jpg') }}"
                                alt="Him" class="w-full h-auto object-cover">
                        </div>
                    </div>

                    <!-- Her -->
                    <div class="w-full md:w-1/2">
                        <div class="overflow-hidden rounded-xl transition-transform duration-300 hover:scale-105">
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
                            class="w-[calc(50vw-2rem)] sm:w-[200px] md:w-[300px] flex-shrink-0 bg-white border border-gray-200 rounded-2xl p-4 shadow transition duration-300 relative flex flex-col justify-between">

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
                                <span class="line-through text-gray-400 text-sm">₹{{ $product['price'] + 1000 }}</span>
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
                            class="w-[calc(50vw-2rem)] sm:w-[200px] md:w-[300px] flex-shrink-0 bg-white border border-gray-200 rounded-2xl p-4 shadow transition duration-300 relative flex flex-col justify-between">

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
                                <span class="line-through text-gray-400 text-sm">₹{{ $product['price'] + 1000 }}</span>
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
        <section class="bg-amber-50 py-10">
            <h2 class="text-2xl md:text-4xl font-bold text-center text-[#633d2e] mb-10">
                Customer Stories
            </h2>

            <!-- Review Row (scroll on mobile, inline row on desktop) -->
            <div class="max-w-6xl mx-auto overflow-x-auto scrollbar-hide">
                <div class="flex gap-6 px-4 md:justify-center">

                    <!-- Review Card 1 -->
                    <div
                        class="bg-yellow-100 rounded-xl px-6 py-6 min-w-[260px] md:min-w-[280px] flex-shrink-0 flex flex-col items-center text-center shadow-md">
                        <h3 class="font-semibold text-lg mb-3 text-gray-800">Virda</h3>
                        <p class="text-sm text-gray-700 mb-4 leading-relaxed">
                            A big shout out to you guys for improving my hubby's gifting tastes. Completely in love with my
                            ring!
                        </p>
                        <img src="{{ asset('images/files/review-1.jpg') }}" alt="Virda"
                            class="rounded-full w-14 h-14 object-cover border-4 border-white shadow-md" />
                    </div>

                    <!-- Review Card 2 -->
                    <div
                        class="bg-yellow-100 rounded-xl px-6 py-6 min-w-[260px] md:min-w-[280px] flex-shrink-0 flex flex-col items-center text-center shadow-md">
                        <h3 class="font-semibold text-lg mb-3 text-gray-800">Harshika</h3>
                        <p class="text-sm text-gray-700 mb-4 leading-relaxed">
                            Never thought buying jewellery would be this easy, thanks for helping make my mom's birthday
                            special.
                        </p>
                        <img src="{{ asset('images/files/review-2.jpg') }}" alt="Harshika"
                            class="rounded-full w-14 h-14 object-cover border-4 border-white shadow-md" />
                    </div>

                    <!-- Review Card 3 -->
                    <div
                        class="bg-yellow-100 rounded-xl px-6 py-6 min-w-[260px] md:min-w-[280px] flex-shrink-0 flex flex-col items-center text-center shadow-md">
                        <h3 class="font-semibold text-lg mb-3 text-gray-800">Priya</h3>
                        <p class="text-sm text-gray-700 mb-4 leading-relaxed">
                            Gifted these earrings to my sister on her wedding and she loved them! I am obsessed with buying
                            gifts
                            from GIVA.
                        </p>
                        <img src="{{ asset('images/files/review-3.jpg') }}" alt="Priya"
                            class="rounded-full w-14 h-14 object-cover border-4 border-white shadow-md" />
                    </div>

                    <!-- Review Card 4 -->
                    <div
                        class="bg-yellow-100 rounded-xl px-6 py-6 min-w-[260px] md:min-w-[280px] flex-shrink-0 flex flex-col items-center text-center shadow-md">
                        <h3 class="font-semibold text-lg mb-3 text-gray-800">Rohan</h3>
                        <p class="text-sm text-gray-700 mb-4 leading-relaxed">
                            I was looking for a unique gift for my girlfriend and found the perfect bracelet here. She loved
                            it!
                        </p>
                        <img src="{{ asset('images/files/review-4.jpg') }}" alt="Rohan"
                            class="rounded-full w-14 h-14 object-cover border-4 border-white shadow-md" />
                    </div>
                </div>
            </div>

            <!-- Hide Scrollbar CSS -->
            <style>
                .scrollbar-hide::-webkit-scrollbar {
                    display: none;
                }

                .scrollbar-hide {
                    -ms-overflow-style: none;
                    scrollbar-width: none;
                }
            </style>

            </div>
        </section>


    </section>

    <!-- ===== Scripts ===== -->
    <script>
        // ===== DESKTOP SLIDESHOW =====
        const desktopSlideshow = document.getElementById('desktopSlideshow');
        const desktopSlides = [...desktopSlideshow.children];
        let desktopCurrent = 1;

        // Clone first and last slides
        const firstClone = desktopSlides[0].cloneNode(true);
        const lastClone = desktopSlides[desktopSlides.length - 1].cloneNode(true);

        desktopSlideshow.appendChild(firstClone);
        desktopSlideshow.insertBefore(lastClone, desktopSlides[0]);

        const totalDesktopSlides = desktopSlides.length + 2; // Including clones

        desktopSlideshow.style.transform = `translateX(-100%)`; // Start at actual first slide

        function showDesktopSlide(index) {
            desktopSlideshow.style.transition = 'transform 0.7s ease-in-out';
            desktopSlideshow.style.transform = `translateX(-${index * 100}%)`;
        }

        document.getElementById('prevDesktopSlide')?.addEventListener('click', () => {
            if (desktopCurrent <= 0) return;
            desktopCurrent--;
            showDesktopSlide(desktopCurrent);
        });

        document.getElementById('nextDesktopSlide')?.addEventListener('click', () => {
            if (desktopCurrent >= totalDesktopSlides - 1) return;
            desktopCurrent++;
            showDesktopSlide(desktopCurrent);
        });

        desktopSlideshow.addEventListener('transitionend', () => {
            if (desktopCurrent === 0) {
                desktopSlideshow.style.transition = 'none';
                desktopCurrent = totalDesktopSlides - 2;
                desktopSlideshow.style.transform = `translateX(-${desktopCurrent * 100}%)`;
            } else if (desktopCurrent === totalDesktopSlides - 1) {
                desktopSlideshow.style.transition = 'none';
                desktopCurrent = 1;
                desktopSlideshow.style.transform = `translateX(-${desktopCurrent * 100}%)`;
            }
        });

        setInterval(() => {
            desktopCurrent++;
            showDesktopSlide(desktopCurrent);
        }, 5000);

        // ===== MOBILE SLIDESHOW =====
        const mobileSlideshow = document.getElementById('mobileSlideshow');
        const mobileSlides = [...mobileSlideshow.children];
        let mobileCurrent = 1;

        // Clone first and last
        const mobileFirstClone = mobileSlides[0].cloneNode(true);
        const mobileLastClone = mobileSlides[mobileSlides.length - 1].cloneNode(true);

        mobileSlideshow.appendChild(mobileFirstClone);
        mobileSlideshow.insertBefore(mobileLastClone, mobileSlides[0]);

        const totalMobileSlides = mobileSlides.length + 2;

        mobileSlideshow.style.transform = `translateX(-100%)`;

        function showMobileSlide(index) {
            mobileSlideshow.style.transition = 'transform 0.7s ease-in-out';
            mobileSlideshow.style.transform = `translateX(-${index * 100}%)`;
        }

        document.getElementById('prevMobileSlide')?.addEventListener('click', () => {
            if (mobileCurrent <= 0) return;
            mobileCurrent--;
            showMobileSlide(mobileCurrent);
        });
        document.getElementById('nextMobileSlide')?.addEventListener('click', () => {
            if (mobileCurrent >= totalMobileSlides - 1) return;
            mobileCurrent++;
            showMobileSlide(mobileCurrent);
        });

        mobileSlideshow.addEventListener('transitionend', () => {
            if (mobileCurrent === 0) {
                mobileSlideshow.style.transition = 'none';
                mobileCurrent = totalMobileSlides - 2;
                mobileSlideshow.style.transform = `translateX(-${mobileCurrent * 100}%)`;
            } else if (mobileCurrent === totalMobileSlides - 1) {
                mobileSlideshow.style.transition = 'none';
                mobileCurrent = 1;
                mobileSlideshow.style.transform = `translateX(-${mobileCurrent * 100}%)`;
            }
        });

        setInterval(() => {
            mobileCurrent++;
            showMobileSlide(mobileCurrent);
        }, 5000);

        // Scroll Script
        function scrollProduct(dir) {
            const scroller = document.getElementById('product-scroll');
            if (!scroller) return;
            const card = scroller.querySelector(':scope > div');
            const amount = card ? card.getBoundingClientRect().width + 16 : 300; // 16 = gap
            scroller.scrollBy({
                left: dir === 'left' ? -amount : amount,
                behavior: 'smooth'
            });
        }
       window.addEventListener('DOMContentLoaded', () => {
        const splash = document.getElementById('splashScreen');
        const mainContent = document.getElementById('mainContent');

        // Show splash for 2 seconds
        setTimeout(() => {
            // Fade out splash
            splash.style.transition = 'opacity 0.8s ease';
            splash.style.opacity = 0;

            // After fade out, hide splash and show main content
            setTimeout(() => {
                splash.style.display = 'none';
                mainContent.classList.remove('hidden');
            }, 800); // Match fade-out duration
        }, 2000); // Splash duration (2 seconds)
    });
    </script>
    <!-- Hide Scrollbar CSS -->
<style>
    #splashScreen {
        opacity: 1;
        transition: opacity 0.8s ease;
    }
</style>


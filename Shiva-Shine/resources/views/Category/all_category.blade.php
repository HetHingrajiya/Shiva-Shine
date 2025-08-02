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
                <img src="{{ asset('images/files/39-_Gold_Rings_collection_WEB-min3cd6.jpg') }}"
                    class="w-full h-[auto] object-cover flex-shrink-0" alt="Banner 1">
                <img src="{{ asset('images/files/58_silver_jewellery_offer_collection_banner_4_-min6d46.jpg') }}"
                    class="w-full h-[auto] object-cover flex-shrink-0" alt="Banner 2">
                <img src="{{ asset('images/files/05._Bracelets_Collection_banner_web-minbc9a.jpg') }}"
                    class="w-full h-[auto] object-cover flex-shrink-0" alt="Banner 3">
                <img src="{{ asset('images/files/106_rakhi_gold_jewellery__offer_collection_banner-min7f51.jpg') }}"
                    class="w-full h-[auto] object-cover flex-shrink-0" alt="Banner 4">
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
        <div class="relative w-full overflow-hidden md:hidden  mt-10">
            <div id="mobileSlideshow" class="flex transition-transform duration-700 ease-in-out">
                <img src="{{ asset('images/files/39-_Gold_Rings_collection_PHONE-min7d03.jpg') }}"
                    class="w-full rounded shadow-md flex-shrink-0" alt="Mobile Banner 1">
                <img src="{{ asset('images/files/58_silver_jewellery_collection_phone_banner_4_-min5f21.jpg') }}"
                    class="w-full rounded shadow-md flex-shrink-0" alt="Mobile Banner 2">
                <img src="{{ asset('images/files/05._Bracelets_Collection_banner_phone-minddb5.jpg') }}"
                    class="w-full rounded shadow-md flex-shrink-0" alt="Mobile Banner 3">
                <img src="{{ asset('images/files/106_rakhi_gold_jewellery__offer_collection_phone-min49dd.jpg') }}"
                    class="w-full rounded shadow-md flex-shrink-0" alt="Mobile Banner 4">
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

        </div>



    </section>
     <!-- ===== Category Section ===== -->
        <section class="bg-[#EBEBED] py-6 px-4">
            <h2 class="text-2xl md:text-3xl font-semibold text-center text-[#633d2e] mb-6">Shop by Category</h2>

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

            <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2 max-w-6xl mx-auto">
                @foreach ($products as $product)
                    <div
                        class="bg-white rounded-lg overflow-hidden shadow-sm relative group transition transform hover:-translate-y-1">

                        <!-- Wishlist Icon -->
                        <button class="absolute top-2 right-2 z-10 text-gray-500 hover:text-red-500 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 fill-current" viewBox="0 0 24 24">
                                <path d="M12.1 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5
                            2 5.42 4.42 3 7.5 3c1.74 0 3.41 0.81
                            4.5 2.09C13.09 3.81 14.76 3 16.5 3
                            19.58 3 22 5.42 22 8.5c0 3.78-3.4
                            6.86-8.55 11.54l-1.35 1.31z" />
                            </svg>
                        </button>

                        <!-- Product Image -->
                        <img src="{{ asset($product['image']) }}" alt="{{ $product['name'] }}"
                            class="w-full aspect-[4/5] object-cover group-hover:scale-105 transition-transform duration-300" />

                        <!-- Rating -->
                        <div
                            class="absolute bottom-28 left-2 bg-white bg-opacity-90 rounded px-2 text-sm text-yellow-500 font-semibold flex items-center gap-1">
                            <span>4.8</span>
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                <path d="M12 .587l3.668 7.568L24 9.423l-6 5.845
                            1.416 8.232L12 18.896l-7.416 4.604L6
                            15.268 0 9.423l8.332-1.268z" />
                            </svg>
                            <span class="text-gray-600">(134)</span>
                        </div>

                        <!-- Product Info -->
                        <div class="p-3 text-center space-y-1">
                            <p class="text-gray-700 font-semibold text-sm truncate">{{ $product['name'] }}</p>
                            <p class="text-[#d33f5f] font-bold text-lg">
                                ₹{{ number_format($product['price']) }}
                                <span
                                    class="text-gray-400 line-through text-sm ml-1">₹{{ number_format($product['price'] + 1500) }}</span>
                            </p>
                        </div>

                        <!-- Add to Cart Button -->
                        <button
                            class="w-full bg-[#ffd9df] hover:bg-[#fcb8c5] text-[#633d2e] font-semibold py-2 rounded-b transition">
                            Add to Cart
                        </button>
                    </div>
                @endforeach
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

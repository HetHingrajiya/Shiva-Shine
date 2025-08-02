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
                    class="w-full h-[auto] object-cover flex-shrink-0" alt="Banner 1">
                <img src="{{ asset('images/files/58_silver_jewellery_offer_hero_web_1_-mind2de.jpg') }}"
                    class="w-full h-[auto] object-cover flex-shrink-0" alt="Banner 2">
                <img src="{{ asset('images/files/35-Personalised_Rakhi_Hero_Web-min7bb2.jpg') }}"
                    class="w-full h-[auto] object-cover flex-shrink-0" alt="Banner 3">
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

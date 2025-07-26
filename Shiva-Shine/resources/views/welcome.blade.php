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
    .scrollbar-hide::-webkit-scrollbar { display: none; }
    .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }
  </style>
</head>
<body>

  {{-- Navbar --}}
  @include('components.navbar')
<section class="pt-20">
  <!-- ===== Desktop Slideshow ===== -->
  <div class="relative w-full overflow-hidden hidden md:block mt-10">
    <div id="desktopSlideshow" class="flex transition-transform duration-700 ease-in-out">
      <img src="{{ asset('images/files/106_rakhi_gold_jewellery__offer_hero_web-minda97.jpg') }}" class="w-full h-[550px] object-cover flex-shrink-0" alt="Banner 1">
      <img src="{{ asset('images/files/58_silver_jewellery_offer_hero_web_1_-mind2de.jpg') }}" class="w-full h-[550px] object-cover flex-shrink-0" alt="Banner 2">
      <img src="{{ asset('images/files/35-Personalised_Rakhi_Hero_Web-min7bb2.jpg') }}" class="w-full h-[550px] object-cover flex-shrink-0" alt="Banner 3">
    </div>

    <!-- Arrows -->
    <button id="prevDesktopSlide" class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-white/20 p-2 rounded-full shadow z-10">
      <svg class="w-6 h-6 text-white/70" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M15 19l-7-7 7-7"/></svg>
    </button>
    <button id="nextDesktopSlide" class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-white/20 p-2 rounded-full shadow z-10">
      <svg class="w-6 h-6 text-white/70" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 5l7 7-7 7"/></svg>
    </button>
  </div>

  <!-- ===== Mobile Slideshow ===== -->
  <div class="relative w-full overflow-hidden md:hidden px-4 mt-10">
    <div id="mobileSlideshow" class="flex transition-transform duration-700 ease-in-out">
      <img src="{{ asset('images/files/106_rakhi_gold_jewellery__offer_hero_phone_-min5d78.jpg') }}" class="w-full rounded shadow-md flex-shrink-0" alt="Mobile Banner 1">
      <img src="{{ asset('images/files/58_silver_jewellery_offer_hero_phone_1_-min02f3.jpg') }}" class="w-full rounded shadow-md flex-shrink-0" alt="Mobile Banner 2">
      <img src="{{ asset('images/files/35-Personalised_Rakhi_Hero_Phone-minc113.jpg') }}" class="w-full rounded shadow-md flex-shrink-0" alt="Mobile Banner 3">
    </div>

    <!-- Arrows -->
    <button id="prevMobileSlide" class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-white p-2 rounded-full shadow z-10">
      <svg class="w-6 h-6 text-pink-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M15 19l-7-7 7-7"/></svg>
    </button>
    <button id="nextMobileSlide" class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-white p-2 rounded-full shadow z-10">
      <svg class="w-6 h-6 text-pink-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 5l7 7-7 7"/></svg>
    </button>
  </div>

  <!-- ===== Circular Category Slider Section ===== -->
  <div class="px-4 mt-10 relative">
    <!-- Left Arrow -->
    <button onclick="scrollSlider('left')" class="absolute left-2 top-1/2 transform -translate-y-1/2 bg-white hover:bg-pink-100 text-pink-400 rounded-full p-2 shadow-md z-10">
      <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
    </button>

    <!-- Scrollable Slider -->
    <div class="px-4 md:px-6">
      <div id="category-slider" class="flex space-x-1 md:space-x-6 overflow-x-auto scrollbar-hide pb-4 scroll-smooth">
        @foreach([
          ['label' => 'Personalised', 'src' => 'images/files/8_5c398.jpg'],
          ['label' => 'Earrings', 'src' => 'images/files/ER0584_3f06c.jpg'],
          ['label' => 'Bracelet', 'src' => 'images/files/BR01176_5cc57.jpg'],
          ['label' => 'Rings', 'src' => 'images/files/GDLBBR012_56e78.jpg'],
          ['label' => 'Earrings', 'src' => 'images/files/ER0584_3f06c.jpg'],
          ['label' => 'Bracelet', 'src' => 'images/files/BR01176_5cc57.jpg'],
          ['label' => 'Rings', 'src' => 'images/files/GDLBBR012_56e78.jpg'],
          ['label' => 'Earrings', 'src' => 'images/files/ER0584_3f06c.jpg'],
          ['label' => 'Bracelet', 'src' => 'images/files/BR01176_5cc57.jpg'],
          ['label' => 'Rings', 'src' => 'images/files/GDLBBR012_56e78.jpg'],

        ] as $item)
          <div class="flex flex-col items-center min-w-[110px] md:min-w-[220px]">
            <div class="w-[90px] h-[90px] md:w-[200px] md:h-[200px] flex items-center justify-center hover:scale-105 transition-transform border border-[#D4AF37] rounded-[40px] md:rounded-[80px]">
              <img src="{{ asset($item['src']) }}" alt="{{ $item['label'] }}" class="object-cover w-full h-full rounded-[39px] md:rounded-[79px]" />
            </div>
            <span class="mt-1 text-xl md:text-2xl font-medium text-gray-800 text-center">
                {{ $item['label'] }}
            </span>

          </div>
        @endforeach
      </div>
    </div>

    <!-- Right Arrow -->
    <button onclick="scrollSlider('right')" class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-white hover:bg-pink-100 text-pink-400 rounded-full p-2 shadow-md z-10">
      <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
    </button>
  </div>


<!-- ===== Shop by Recipient Section ===== -->
<section class="py-20 bg-white mt-20">
  <h2 class="text-center text-3xl md:text-4xl font-semibold text-[#633d2e] mb-10">
    Shop by Recipient
  </h2>

  <div class="max-w-7xl mx-auto px-4">
    <div class="flex justify-center items-center flex-wrap md:flex-nowrap gap-4 md:gap-10">

      <!-- Him -->
      <div class="w-1/2 max-w-[160px] md:max-w-none md:w-1/2">
        <img src="{{ asset('images/files/him_4_-min_9a1111cf-2eb7-4f4f-af34-fd85f064584c2034.jpg') }}"
             alt="Him"
             class="w-full h-auto object-cover rounded-xl">
      </div>

      <!-- Her -->
      <div class="w-1/2 max-w-[160px] md:max-w-none md:w-1/2">
        <img src="{{ asset('images/files/her_1_-min_68668776-8dc0-4f43-a333-a630a36fddee2034.jpg') }}"
             alt="Her"
             class="w-full h-auto object-cover rounded-xl">
      </div>

    </div>
  </div>
</section>

<!-- Horizontal Product Recycler View -->
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
        'image' => 'images/files/GDLER0302.40179a9f8.jpg',
      ],
      [
        'name' => 'Couple Bracelets',
        'price' => 2999,
        'category' => 'Bracelet',
        'image' => 'images/files/AVBR002_10d4b.jpg',
      ],
      [
        'name' => 'Lock & Key Pendants',
        'price' => 3199,
        'category' => 'Pendant',
        'image' => 'images/files/GDLBR018.404297107.jpg',
      ],
      [
        'name' => 'Name Engraved Rings',
        'price' => 2799,
        'category' => 'Rings',
        'image' => 'images/files/GDLR030_34305.jpg',
      ],
      // Duplicate entries for scroll effect
      [
        'name' => 'His & Her Rings',
        'price' => 2499,
        'category' => 'Rings',
        'image' => 'images/files/GDLER0302.40179a9f8.jpg',
      ],
      [
        'name' => 'Couple Bracelets',
        'price' => 2999,
        'category' => 'Bracelet',
        'image' => 'images/files/AVBR002_10d4b.jpg',
      ],
      [
        'name' => 'Name Engraved Rings',
        'price' => 2799,
        'category' => 'Rings',
        'image' => 'images/files/GDLR030_34305.jpg',
      ],
      [
        'name' => 'Lock & Key Pendants',
        'price' => 3199,
        'category' => 'Pendant',
        'image' => 'images/files/GDLBR018.404297107.jpg',
      ],
    ];
  @endphp

  <div class="relative">
    <!-- Scroll Buttons -->
    <button onclick="scrollProduct('left')" class="absolute left-0 top-1/2 transform -translate-y-1/2 z-10 bg-white shadow p-2 rounded-full">
      <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path d="M15 19l-7-7 7-7" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
      </svg>
    </button>
    <button onclick="scrollProduct('right')" class="absolute right-0 top-1/2 transform -translate-y-1/2 z-10 bg-white shadow p-2 rounded-full">
      <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path d="M9 5l7 7-7 7" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
      </svg>
    </button>

    <!-- Product Cards -->
    <div id="product-scroll" class="flex overflow-x-auto space-x-4 scrollbar-hide scroll-smooth px-10 py-2">
      @foreach($products as $product)
        <div class="relative min-w-[400px] min-h-[540px] bg-white border border-gray-200 rounded-xl p-5 shadow hover:shadow-xl transition overflow-hidden">

        <!-- Wishlist Icon -->
        <button class="absolute top-4 right-4 text-gray-400 hover:text-pink-500 focus:outline-none">
            <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24">
            <path d="M12.1 8.64l-.1.1-.11-.1C10.14 6.86 7.5 7.22 6.15 9.04c-1.32 1.75-.96 4.32.99 6.29L12 21.35l4.86-6.01c1.94-1.97 2.31-4.54.99-6.29-1.35-1.82-3.99-2.18-5.75-.41z"/>
            </svg>
        </button>

        <img src="{{ asset($product['image']) }}" alt="{{ $product['name'] }}"
            class="w-full h-[280px] object-cover rounded-lg mb-4 shadow-sm">

        <div class="text-sm text-gray-600 mb-1">{{ $product['category'] }}</div>
        <h3 class="font-semibold text-xl text-gray-800 mb-2">{{ $product['name'] }}</h3>

        <div class="flex items-center gap-2 mb-2">
            <span class="text-pink-600 font-bold text-lg">₹{{ $product['price'] }}</span>
            <span class="line-through text-gray-400 text-sm">₹{{ $product['price'] + 1000 }}</span>
        </div>

        <div class="flex items-center mb-3">
            <span class="text-yellow-400 text-base">★ 4.8</span>
            <span class="text-sm text-gray-400 ml-2">(100+)</span>
        </div>

        <button class="w-full bg-pink-100 hover:bg-pink-200 text-pink-600 font-semibold py-2 rounded-lg transition">
            Add to Cart
        </button>
        </div>

      @endforeach
    </div>
  </div>
</section>


<!-- ===== Men's Collection Horizontal Scroll ===== -->
<section class="w-full bg-white py-20">
  <div class="max-w-[1440px] mx-auto px-4">
    <h2 class="text-center text-3xl md:text-4xl font-semibold text-[#633d2e] mb-2">
      Men's Collection
    </h2>
    <p class="text-center text-gray-500 mb-10 text-lg">Jewellery That Defines Him</p>

    @php
      $mensCards = [
        ['title' => 'Work Picks', 'image' => 'images/files/work_chain.jpg'],
        ['title' => 'Party Picks', 'image' => 'images/files/party_tag.jpg'],
        ['title' => 'Spiritual Picks', 'image' => 'images/files/shiv_trishul.jpg'],
        ['title' => 'Daily Picks', 'image' => 'images/files/plain_ring.jpg'],
        ['title' => 'Wedding Picks', 'image' => 'images/files/wedding_ring.jpg'],
      ];
    @endphp

    <!-- Scrollable Card Container -->
    <div class="flex overflow-x-auto gap-8 scrollbar-hide scroll-smooth px-6 py-2">
      @foreach($mensCards as $card)
        <div class="min-w-[220px] sm:min-w-[240px] md:min-w-[260px] bg-white rounded-3xl overflow-hidden shadow-lg hover:shadow-xl transition duration-300 flex-shrink-0">
          <img src="{{ asset($card['image']) }}" alt="{{ $card['title'] }}"
               class="w-full h-[300px] object-cover rounded-t-3xl" />
          <div class="py-5 px-4 text-center">
            <h3 class="text-lg md:text-xl font-semibold text-gray-800">{{ $card['title'] }}</h3>
          </div>
        </div>
      @endforeach
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

   // Optional: Scroll Script
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

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Raksha Bandhan Offer</title>

  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Alpine.js (if needed) -->
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

  <!-- Optional: Hide scrollbar -->
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
<body class="bg-[#fef8f3]">

  {{-- Include Navigation Bar --}}
  @include('components.navbar')

  <!-- ===== Desktop Slideshow ===== -->
  <div class="relative w-full overflow-hidden hidden md:block">
    <div id="desktopSlideshow" class="flex transition-transform duration-700 ease-in-out">
      <img src="{{ asset('images/files/106_rakhi_gold_jewellery__offer_hero_web-minda97.jpg') }}" class="w-full h-[550px] object-cover flex-shrink-0" alt="Banner 1">
      <img src="{{ asset('images/files/58_silver_jewellery_offer_hero_web_1_-mind2de.jpg') }}" class="w-full h-[550px] object-cover flex-shrink-0" alt="Banner 2">
      <img src="{{ asset('images/files/35-Personalised_Rakhi_Hero_Web-min7bb2.jpg') }}" class="w-full h-[550px] object-cover flex-shrink-0" alt="Banner 3">
    </div>
   <!-- Controls -->
    <button id="prevDesktopSlide" class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-white/20 p-2 rounded-full shadow z-10">
    <svg class="w-6 h-6 text-white/70" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path d="M15 19l-7-7 7-7"/>
    </svg>
    </button>
    <button id="nextDesktopSlide" class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-white/20 p-2 rounded-full shadow z-10">
    <svg class="w-6 h-6 text-white/70" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path d="M9 5l7 7-7 7"/>
    </svg>
    </button>

  </div>

  <!-- ===== Mobile Slideshow ===== -->
  <div class="relative w-full overflow-hidden md:hidden px-4 mt-4">
    <div id="mobileSlideshow" class="flex transition-transform duration-700 ease-in-out">
      <img src="{{ asset('images/files/106_rakhi_gold_jewellery__offer_hero_phone_-min5d78.jpg') }}" class="w-full rounded shadow-md flex-shrink-0" alt="Mobile Banner 1">
      <img src="{{ asset('images/files/58_silver_jewellery_offer_hero_phone_1_-min02f3.jpg') }}" class="w-full rounded shadow-md flex-shrink-0" alt="Mobile Banner 2">
      <img src="{{ asset('images/files/35-Personalised_Rakhi_Hero_Phone-minc113.jpg') }}" class="w-full rounded shadow-md flex-shrink-0" alt="Mobile Banner 3">
    </div>
    <!-- Controls -->
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
  <button
    onclick="scrollSlider('left')"
    class="absolute left-2 top-1/2 transform -translate-y-1/2 bg-white hover:bg-pink-100 text-pink-400 rounded-full p-2 shadow-md z-10 transition"
    aria-label="Scroll Left"
  >
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
    </svg>
  </button>

  <!-- Scrollable Slider -->
<div class="px-4 md:px-6 relative">
  <div
    id="category-slider"
    class="flex space-x-1 md:space-x-6 overflow-x-auto scrollbar-hide pb-4 scroll-smooth"
  >
    @foreach([
      ['label' => 'Personalised', 'src' => 'images/files/8_5c398.jpg'],
      ['label' => 'Earrings', 'src' => 'images/files/ER0584_3f06c.jpg'],
      ['label' => 'Bracelet', 'src' => 'images/files/BR01176_5cc57.jpg'],
      ['label' => 'Rings', 'src' => 'images/files/GDLBBR012_56e78.jpg'],
      ['label' => 'Earrings', 'src' => 'images/files/ER0584_3f06c.jpg'],
      ['label' => 'Bracelet', 'src' => 'images/files/BR01176_5cc57.jpg'],
      ['label' => 'Rings', 'src' => 'images/files/GDLBBR012_56e78.jpg'],
      ['label' => 'Rings', 'src' => 'images/files/GDLBBR012_56e78.jpg'],
      ['label' => 'Earrings', 'src' => 'images/files/ER0584_3f06c.jpg'],
      ['label' => 'Bracelet', 'src' => 'images/files/BR01176_5cc57.jpg'],
      ['label' => 'Rings', 'src' => 'images/files/GDLBBR012_56e78.jpg'],
    ] as $item)
      <div class="flex flex-col items-center min-w-[110px] md:min-w-[220px]">
        <div class="w-[90px] h-[90px] md:w-[200px] md:h-[200px] flex items-center justify-center hover:scale-105 transition-transform border border-[#D4AF37] rounded-[40px] md:rounded-[80px]">
          <img src="{{ asset($item['src']) }}" alt="{{ $item['label'] }}"
            class="object-cover w-full h-full rounded-[39px] md:rounded-[79px]" />
        </div>
        <span class="mt-1 text-xs md:text-sm font-medium text-gray-800 text-center">
          {{ $item['label'] }}
        </span>
      </div>
    @endforeach
  </div>
</div>



  <!-- Right Arrow -->
  <button
    onclick="scrollSlider('right')"
    class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-white hover:bg-pink-100 text-pink-400 rounded-full p-2 shadow-md z-10 transition"
    aria-label="Scroll Right"
  >
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
    </svg>
  </button>
</div>

<!-- JS Scroll Script -->
<script>
  function scrollSlider(direction) {
    const slider = document.getElementById("category-slider");
    const scrollAmount = 220;
    slider.scrollBy({
      left: direction === "left" ? -scrollAmount : scrollAmount,
      behavior: "smooth",
    });
  }
</script>

  <!-- ===== JavaScript Slideshow ===== -->
  <script>
    // Desktop slideshow logic
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

    function scrollSlider(direction) {
    const slider = document.getElementById('category-slider');
    const scrollAmount = 200;
    if (direction === 'left') {
      slider.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
    } else {
      slider.scrollBy({ left: scrollAmount, behavior: 'smooth' });
    }
    }
  </script>

</body>
</html>

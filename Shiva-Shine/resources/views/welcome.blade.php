@include('components.navbar')

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Raksha Bandhan Offer</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#fef8f3]">

  <!-- Slideshow Banner -->
  <div class="w-full relative overflow-hidden">
    <div class="slideshow flex transition-transform duration-700" id="slideshow">
      <img src="{{ asset('images/banner1.jpg') }}" alt="Banner 1" class="w-full h-64 object-cover flex-shrink-0">
      <img src="{{ asset('images/banner2.jpg') }}" alt="Banner 2" class="w-full h-64 object-cover flex-shrink-0">
      <img src="{{ asset('images/banner3.jpg') }}" alt="Banner 3" class="w-full h-64 object-cover flex-shrink-0">
    </div>
    <!-- Slideshow controls -->
    <button id="prevSlide" class="absolute left-2 top-1/2 -translate-y-1/2 bg-white bg-opacity-70 rounded-full p-2 shadow hover:bg-opacity-100">
      <svg class="w-5 h-5 text-pink-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M15 19l-7-7 7-7"/></svg>
    </button>
    <button id="nextSlide" class="absolute right-2 top-1/2 -translate-y-1/2 bg-white bg-opacity-70 rounded-full p-2 shadow hover:bg-opacity-100">
      <svg class="w-5 h-5 text-pink-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 5l7 7-7 7"/></svg>
    </button>
  </div>

  <script>
    // Simple JS slideshow (replace images as needed)
    const slideshow = document.getElementById('slideshow');
    const slides = slideshow.children;
    let current = 0;
    function showSlide(idx) {
      slideshow.style.transform = `translateX(-${idx * 100}%)`;
    }
    document.getElementById('prevSlide').onclick = () => {
      current = (current - 1 + slides.length) % slides.length;
      showSlide(current);
    };
    document.getElementById('nextSlide').onclick = () => {
      current = (current + 1) % slides.length;
      showSlide(current);
    };
    // Optional: auto-slide
    setInterval(() => {
      current = (current + 1) % slides.length;
      showSlide(current);
    }, 5000);
  </script>

  <!-- Banner Section -->
  <div class="w-full bg-gradient-to-r from-pink-100 via-pink-200 to-pink-100 py-3 px-4 flex items-center justify-center">
    <span class="text-pink-700 font-semibold text-base md:text-lg tracking-wide flex items-center gap-2">
      <svg class="w-5 h-5 text-pink-500" fill="currentColor" viewBox="0 0 20 20">
        <path d="M10 2a8 8 0 100 16 8 8 0 000-16zm1 12H9v-2h2v2zm0-4H9V6h2v4z"/>
      </svg>
      Celebrate Raksha Bandhan with Exclusive Offers! Free Shipping on All Orders 🚚✨
    </span>
  </div>

  <div class="max-w-screen-xl mx-auto grid md:grid-cols-2 gap-6 px-4 py-12 items-center">

    <!-- Jewelry Image (Left) -->
    <div class="flex justify-center">
      <img src="{{ asset('images/jewelry.png') }}" alt="Jewelry Offer" class="w-full max-w-[400px]">
    </div>

    <!-- Offer Section (Right) -->
    <div class="text-center md:text-left space-y-6">
      <h2 class="text-4xl font-semibold text-[#712f3c]">Raksha Bandhan</h2>
      <p class="text-lg font-medium text-gray-700">Special</p>

      <div class="flex flex-wrap justify-center md:justify-start gap-4">
        <!-- Offer 1 -->
        <div class="bg-white rounded-lg p-4 shadow w-40 text-center">
          <p class="font-bold text-sm text-gray-800">FLAT</p>
          <h3 class="text-2xl text-[#712f3c] font-extrabold">10%</h3>
          <p class="text-xs text-gray-600">Above ₹1699</p>
          <p class="mt-2 text-xs">CODE: <span class="font-semibold">RAKSHA10</span></p>
        </div>

        <!-- Offer 2 -->
        <div class="bg-white rounded-lg p-4 shadow w-40 text-center">
          <p class="font-bold text-sm text-gray-800">FLAT</p>
          <h3 class="text-2xl text-[#712f3c] font-extrabold">20%</h3>
          <p class="text-xs text-gray-600">Above ₹5999</p>
          <p class="mt-2 text-xs">CODE: <span class="font-semibold">RAKSHA20</span></p>
        </div>
      </div>

      <a href="#" class="inline-block bg-[#d93f87] hover:bg-[#c13275] text-white font-semibold py-2 px-6 rounded-full transition">
        SHOP NOW
      </a>
    </div>

  </div>

  <!-- Model Image Below for Mobile, Side-by-Side for Large Screens -->
  <div class="flex justify-center md:hidden px-4">
    <img src="{{ asset('images/model.png') }}" alt="Model" class="w-full max-w-xs">
  </div>

</body>
</html>

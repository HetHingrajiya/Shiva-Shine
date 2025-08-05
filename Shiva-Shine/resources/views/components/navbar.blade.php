{{-- <nav class="fixed top-0 left-0 w-full z-50 bg-[#fffaf7] shadow-sm border-b border-gray-200" x-data="{ open: false }">
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Mobile View: Top Row -->
        <div class="flex items-center justify-between h-16 sm:hidden w-full">
            <!-- Hamburger -->
            <button @click="open = !open" class="focus:outline-none">
                <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                <svg x-show="open" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <!-- Logo Center -->
            <a href="{{ url('/') }}" class="text-xl font-bold text-gray-900">Shiva Shine</a>

            <!-- Icons Right -->
            <div class="flex space-x-4 text-gray-700">
                @foreach (['Account', 'Wishlist', 'Cart'] as $i => $label)
                    @php
                        $iconsPath = [
                            'M12 12a5 5 0 100-10 5 5 0 000 10z M4 22a8 8 0 0116 0',
                            'M4.318 6.318a4.5 4.5 0 016.364 0L12 7.636l1.318-1.318a4.5 4.5 0 116.364 6.364L12 21.682l-7.682-8.682a4.5 4.5 0 010-6.364z',
                            'M3 3h2l.4 2M7 13h10l4-8H5.4 M7 21a1 1 0 100-2 1 1 0 000 2z M20 21a1 1 0 100-2 1 1 0 000 2z',
                        ];
                    @endphp
                    <a href="#" class="flex flex-col items-center text-xs">
                        <svg class="w-5 h-5 mb-0.5" fill="none" stroke="currentColor" stroke-width="1.5"
                            viewBox="0 0 24 24">
                            <path d="{{ $iconsPath[$i] }}" />
                        </svg>
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Mobile Search Bar Below -->
        <div class="sm:hidden mt-2 mb-4">
            <form class="flex bg-white border border-gray-200 rounded-full px-2 py-1 shadow-sm">
                <input type="text" placeholder="Search..."
                    class="flex-1 px-3 py-2 text-sm outline-none bg-transparent text-gray-700" />
                <button type="submit" class="p-2 rounded-full bg-pink-500 hover:bg-pink-600">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <circle cx="11" cy="11" r="7" />
                        <line x1="21" y1="21" x2="16.65" y2="16.65" />
                    </svg>
                </button>
            </form>
        </div>

        <!-- Desktop View -->
        <div class="hidden sm:flex justify-between items-center h-16">
            <!-- Left: Logo & Location -->
            <div class="flex items-center gap-3">
                <a href="{{ url('/') }}" class="text-2xl font-bold text-gray-900">Shiva Shine</a>
                <button
                    class="hidden sm:flex bg-[#ffe9f1] text-xs text-gray-700 px-3 py-1.5 rounded-full items-center gap-1.5">
                    <svg class="w-4 h-4 text-pink-500" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 2a6 6 0 00-6 6c0 4.5 6 10 6 10s6-5.5 6-10a6 6 0 00-6-6zm0 8a2 2 0 110-4 2 2 0 010 4z" />
                    </svg>
                    <span>Where to Deliver?</span>
                </button>
            </div>

            <!-- Center: Search Bar -->
            <div class="hidden md:flex flex-1 max-w-xl mx-6">
                <form class="w-full flex bg-white border border-gray-200 rounded-full px-2 py-1 shadow-sm">
                    <input type="text" placeholder="Search..."
                        class="flex-1 px-3 py-2 text-sm outline-none bg-transparent text-gray-700" />
                    <button type="submit" class="p-2 rounded-full bg-pink-500 hover:bg-pink-600">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <circle cx="11" cy="11" r="7" />
                            <line x1="21" y1="21" x2="16.65" y2="16.65" />
                        </svg>
                    </button>
                </form>
            </div>

            <!-- Right: Icons -->
            <div class="hidden sm:flex space-x-6 text-sm text-gray-700">
                @php
                    $icons = [
                        ['label' => 'Account', 'icon' => 'M12 12a5 5 0 100-10 5 5 0 000 10z M4 22a8 8 0 0116 0'],
                        [
                            'label' => 'Wishlist',
                            'icon' =>
                                'M4.318 6.318a4.5 4.5 0 016.364 0L12 7.636l1.318-1.318a4.5 4.5 0 116.364 6.364L12 21.682l-7.682-8.682a4.5 4.5 0 010-6.364z',
                        ],
                        [
                            'label' => 'Cart',
                            'icon' =>
                                'M3 3h2l.4 2M7 13h10l4-8H5.4 M7 21a1 1 0 100-2 1 1 0 000 2z M20 21a1 1 0 100-2 1 1 0 000 2z',
                        ],
                    ];
                @endphp
                @foreach ($icons as $icon)
                    <a href="#" class="hover:text-pink-500 flex flex-col items-center">
                        <svg class="w-5 h-5 mb-0.5" fill="none" stroke="currentColor" stroke-width="1.8"
                            viewBox="0 0 24 24">
                            <path d="{{ $icon['icon'] }}" />
                        </svg>
                        <span>{{ $icon['label'] }}</span>
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Navigation Links (Desktop) -->
        <div class="mt-2 hidden sm:flex space-x-6 text-lg text-gray-700 font-medium overflow-x-auto pb-2">
            <a href="{{ route('Category.all_category') }}" class="hover:text-pink-500 whitespace-nowrap">Shop by Category</a>
            <a href="#" class="hover:text-pink-500 whitespace-nowrap">Latest Collections</a>
            <a href="#" class="hover:text-pink-500 whitespace-nowrap">Women's Jewellery</a>
            <a href="#" class="hover:text-pink-500 whitespace-nowrap">Men's Jewellery</a>
            <a href="#" class="hover:text-pink-500 whitespace-nowrap">More at Shiva Shine</a>
        </div>

        <!-- Mobile Dropdown Menu -->
        <div x-show="open" x-transition class="sm:hidden mt-2 px-4 pb-4 space-y-4 text-sm font-medium text-gray-700">
            <!-- Location Button -->
            <button class="w-full flex bg-[#ffe9f1] text-sm text-gray-700 px-3 py-2 rounded-full items-center gap-2">
                <svg class="w-4 h-4 text-pink-500" fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 2a6 6 0 00-6 6c0 4.5 6 10 6 10s6-5.5 6-10a6 6 0 00-6-6zm0 8a2 2 0 110-4 2 2 0 010 4z" />
                </svg>
                <span>Where to Deliver?</span>
            </button>

            <!-- Navigation Links -->
            <a href="{{ route('Category.all_category')}}" class="block hover:text-pink-500">Shop by Category</a>
            <a href="#" class="block hover:text-pink-500">Latest Collections</a>
            <a href="#" class="block hover:text-pink-500">Women's Jewellery</a>
            <a href="#" class="block hover:text-pink-500">Men's Jewellery</a>
            <a href="#" class="block hover:text-pink-500">More at Shiva Shine</a>
        </div>
    </div>
</nav> --}}
<<<<<<< HEAD
=======
<nav class="fixed top-0 left-0 w-full z-50 bg-[#fffaf7] shadow-sm border-b border-gray-200" x-data="{ open: false }">
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
      <!-- Top Nav -->
      <div class="flex items-center justify-between h-16">
        <!-- Left: Logo + Location -->
        <div class="flex items-center gap-4">
          <!-- Mobile Hamburger -->
          <button @click="open = !open" class="sm:hidden focus:outline-none">
            <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
              viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M4 6h16M4 12h16M4 18h16" />
            </svg>
            <svg x-show="open" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
              viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>

          <!-- Logo -->
          <a href="{{ url('/') }}" class="text-2xl font-bold text-gray-900">Shiva Shine</a>

          <!-- Location (Desktop Only) -->
          <button
            class="hidden sm:flex bg-[#ffe9f1] text-xs text-gray-700 px-3 py-1.5 rounded-full items-center gap-1.5">
            <svg class="w-4 h-4 text-pink-500" fill="currentColor" viewBox="0 0 20 20">
              <path
                d="M10 2a6 6 0 00-6 6c0 4.5 6 10 6 10s6-5.5 6-10a6 6 0 00-6-6zm0 8a2 2 0 110-4 2 2 0 010 4z" />
            </svg>
            <span>Where to Deliver?</span>
          </button>
        </div>

        <!-- Center: Search (Desktop) -->
        <div class="hidden md:flex flex-1 mx-8">
          <form class="flex flex-1 bg-white border border-gray-300 rounded-full px-4 py-2 shadow-sm">
            <input type="text" placeholder='Search "Rings"' class="flex-1 text-sm outline-none bg-transparent text-gray-700 placeholder-gray-500" />
            <svg class="w-5 h-5 text-gray-500 ml-2" fill="none" stroke="currentColor" stroke-width="2"
              viewBox="0 0 24 24">
              <circle cx="11" cy="11" r="7" />
              <line x1="21" y1="21" x2="16.65" y2="16.65" />
            </svg>
          </form>
        </div>

        <!-- Right: Icons (Desktop) -->
        <div class="hidden sm:flex items-center space-x-6 text-sm">
          @php
          $icons = [
            ['label' => 'ACCOUNT', 'icon' => 'M12 12a5 5 0 100-10 5 5 0 000 10z M4 22a8 8 0 0116 0'],
            ['label' => 'WISHLIST', 'icon' => 'M4.318 6.318a4.5 4.5 0 016.364 0L12 7.636l1.318-1.318a4.5 4.5 0 116.364 6.364L12 21.682l-7.682-8.682a4.5 4.5 0 010-6.364z'],
            ['label' => 'CART', 'icon' => 'M3 3h2l.4 2M7 13h10l4-8H5.4 M7 21a1 1 0 100-2 1 1 0 000 2z M20 21a1 1 0 100-2 1 1 0 000 2z'],
          ];
          @endphp
          @foreach ($icons as $icon)
          <a href="#" class="flex flex-col items-center hover:text-pink-500">
            <svg class="w-5 h-5 mb-0.5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
              <path d="{{ $icon['icon'] }}" />
            </svg>
            <span class="text-xs">{{ $icon['label'] }}</span>
          </a>
          @endforeach
        </div>

        <!-- Right: Icons (Mobile) -->
        <div class="sm:hidden flex items-center space-x-4">
          @foreach ($icons as $icon)
          <a href="#" class="hover:text-pink-500">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
              <path d="{{ $icon['icon'] }}" />
            </svg>
          </a>
          @endforeach
        </div>
      </div>

      <!-- Mobile Search: Always Visible -->
      <div class="block md:hidden mt-2 mb-4">
        <form class="w-full flex items-center bg-white border border-gray-300 rounded-full shadow-sm px-4 py-2">
          <svg class="w-5 h-5 text-gray-500 mr-2" fill="none" stroke="currentColor" stroke-width="2"
            viewBox="0 0 24 24">
            <circle cx="11" cy="11" r="7" />
            <line x1="21" y1="21" x2="16.65" y2="16.65" />
          </svg>
          <input type="text" placeholder="Search..."
            class="flex-1 text-sm outline-none bg-transparent text-gray-700 placeholder-gray-400" />
        </form>
      </div>

      <!-- Desktop Nav Links -->
        <div class="hidden sm:flex justify-center w-full mt-2">
            <div class="flex space-x-8 text-lg text-gray-700 font-medium pb-2 overflow-x-auto">
            <a href="#" class="hover:text-pink-500 whitespace-nowrap">Shop by Category</a>
            <a href="#" class="hover:text-pink-500 whitespace-nowrap">Men's Jewellery</a>
            <a href="#" class="hover:text-pink-500 whitespace-nowrap">Women's Jewellery</a>
            <a href="#" class="hover:text-pink-500 whitespace-nowrap">Latest Collections</a>
            <a href="#" class="hover:text-pink-500 whitespace-nowrap">More at Shiva Shine</a>
            </div>
        </div>


      <!-- Mobile Dropdown Menu -->
      <div x-show="open" x-transition class="sm:hidden mt-2 px-4 pb-4 space-y-4 text-sm font-medium text-gray-700">
        <a href="#" class="block hover:text-pink-500">Shop by Category</a>
        <a href="#" class="block hover:text-pink-500">Men's Jewellery</a>
        <a href="#" class="block hover:text-pink-500">Women's Jewellery</a>
        <a href="#" class="block hover:text-pink-500">Latest Collections</a>
        <a href="#" class="block hover:text-pink-500">More at Shiva Shine</a>
      </div>
    </div>
  </nav>
>>>>>>> 2fb9806071477553cb310c5d945a5dcc032710

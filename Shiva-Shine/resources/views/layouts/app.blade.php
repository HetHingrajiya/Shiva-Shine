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

<body class="bg-[#fffaf7] text-[#633d2e]">

    <!-- Header / Navbar -->
    <header class="bg-white shadow-md sticky top-0 z-50">

            <nav class="fixed top-2 left-0 w-full z-50 bg-[#fffaf7] shadow-sm border-b border-gray-200"
                x-data="{ open: false }">
                <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">

                    <!-- Mobile View: Top Row -->
                    <div class="flex items-center justify-between h-16 sm:hidden w-full">
                        <!-- Hamburger -->
                        <button @click="open = !open" class="focus:outline-none">
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

                        <!-- Logo Center -->
                        <a href="{{ url('/') }}" class="block">
                            <img src="{{ asset('images/files/logo.png') }}" alt="Shiva Shine Logo" class="h-20 w-auto">
                        </a>


                        <!-- Icons Right -->
                        <div class="flex space-x-4 text-gray-700">
                            @php
                                $navItems = [
                                    [
                                        'label' => 'Account',
                                        'icon' => 'M12 12a5 5 0 100-10 5 5 0 000 10z M4 22a8 8 0 0116 0',
                                        'link' => route('account.index'), // Example route
                                    ],
                                    [
                                        'label' => 'Wishlist',
                                        'icon' =>
                                            'M4.318 6.318a4.5 4.5 0 016.364 0L12 7.636l1.318-1.318a4.5 4.5 0 116.364 6.364L12 21.682l-7.682-8.682a4.5 4.5 0 010-6.364z',
                                        'link' => route('wishlist.index'), // Route for wishlist
                                        //'count' => session('wishlist_count', 0), // optional count from session
                                    ],
                                    [
                                        'label' => 'Cart',
                                        'icon' =>
                                            'M3 3h2l.4 2M7 13h10l4-8H5.4 M7 21a1 1 0 100-2 1 1 0 000 2z M20 21a1 1 0 100-2 1 1 0 000 2z',
                                        'link' => route('cart.index'), // Route for cart
                                        //'count' => session('cart_count', 0), // optional cart count
                                    ],
                                ];
                            @endphp

                            @foreach ($navItems as $item)
                                <a href="{{ $item['link'] }}"
                                    class="relative flex flex-col items-center text-xs hover:text-pink-600 transition">
                                    <svg class="w-6 h-6 mb-0.5" fill="none" stroke="currentColor" stroke-width="1.5"
                                        viewBox="0 0 24 24">
                                        <path d="{{ $item['icon'] }}" />
                                    </svg>
                                    <span>{{ $item['label'] }}</span>

                                    @if (!empty($item['count']) && $item['count'] > 0)
                                        <span
                                            class="absolute top-0 right-0 -mt-1 -mr-2 bg-pink-600 text-white text-[10px] font-bold rounded-full w-4 h-4 flex items-center justify-center">
                                            {{ $item['count'] }}
                                        </span>
                                    @endif
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
                            <a href="{{ url('/') }}" class="block">
                                <img src="{{ asset('images/files/logo.png') }}" alt="Shiva Shine Logo"
                                    class="h-20 w-160">
                            </a>

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
                        <div class="hidden md:flex flex-1 max-w-xl mx-7 mt-3">
                            <form class="w-full flex bg-white border border-gray-200 rounded-full px-2 py-1 shadow-sm">
                                <input type="text" placeholder="Search..."
                                    class="flex-1 px-3 py-2 text-sm outline-none bg-transparent text-gray-700" />
                                <button type="submit" class="p-2 rounded-full bg-pink-500 hover:bg-pink-600">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                        stroke-width="2" viewBox="0 0 24 24">
                                        <circle cx="11" cy="11" r="7" />
                                        <line x1="21" y1="21" x2="16.65" y2="16.65" />
                                    </svg>
                                </button>
                            </form>
                        </div>

                        <!-- Right: Icons (Desktop) -->
                        <div class="hidden sm:flex space-x-6 text-sm text-gray-700">
                            @php
                                $desktopNavItems = [
                                    [
                                        'label' => 'Account',
                                        'icon' => 'M12 12a5 5 0 100-10 5 5 0 000 10z M4 22a8 8 0 0116 0',
                                        'link' => route('account.index'),
                                    ],
                                    [
                                        'label' => 'Wishlist',
                                        'icon' =>
                                            'M4.318 6.318a4.5 4.5 0 016.364 0L12 7.636l1.318-1.318a4.5 4.5 0 116.364 6.364L12 21.682l-7.682-8.682a4.5 4.5 0 010-6.364z',
                                        'link' => route('wishlist.index'),
                                    ],
                                    [
                                        'label' => 'Cart',
                                        'icon' =>
                                            'M3 3h2l.4 2M7 13h10l4-8H5.4 M7 21a1 1 0 100-2 1 1 0 000 2z M20 21a1 1 0 100-2 1 1 0 000 2z',
                                        'link' => route('cart.index'),
                                    ],
                                ];
                            @endphp

                            @foreach ($desktopNavItems as $item)
                                <a href="{{ $item['link'] }}" class="hover:text-pink-500 flex flex-col items-center">
                                    <svg class="w-5 h-5 mb-0.5" fill="none" stroke="currentColor"
                                        stroke-width="1.8" viewBox="0 0 24 24">
                                        <path d="{{ $item['icon'] }}" />
                                    </svg>
                                    <span>{{ $item['label'] }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <!-- Navigation Links (Desktop) -->
                    <div class="mt-2 hidden sm:flex space-x-6 text-lg text-gray-700 font-medium overflow-x-auto pb-2">
                        <a href="{{ route('Category.all_category') }}"class="hover:text-pink-500 whitespace-nowrap">Shop
                            by Category</a>
                        <a href="{{ route('Category.latest_collections_category') }}"
                            class="hover:text-pink-500 whitespace-nowrap">Latest
                            Collections</a>
                        <a href="{{ route('category.Womens.womens_jewellery') }}"
                            class="hover:text-pink-500 whitespace-nowrap">Women's Jewellery</a>
                        <a href="{{ route('category.mens.mens_jewellery') }}"
                            class="hover:text-pink-500 whitespace-nowrap">
                            Men's Jewellery
                        </a>
                        <a href="#" class="hover:text-pink-500 whitespace-nowrap">More at Shiva Shine</a>
                    </div>

                    <!-- Mobile Dropdown Menu -->
                    <div x-show="open" x-transition
                        class="sm:hidden mt-2 px-4 pb-4 space-y-4 text-sm font-medium text-gray-700">
                        <!-- Location Button -->
                        <button
                            class="w-full flex bg-[#ffe9f1] text-sm text-gray-700 px-3 py-2 rounded-full items-center gap-2">
                            <svg class="w-4 h-4 text-pink-500" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10 2a6 6 0 00-6 6c0 4.5 6 10 6 10s6-5.5 6-10a6 6 0 00-6-6zm0 8a2 2 0 110-4 2 2 0 010 4z" />
                            </svg>
                            <span>Where to Deliver?</span>
                        </button>

                        <!-- Navigation Links -->
                        <a href="{{ route('Category.all_category') }}" class="block hover:text-pink-500">Shop by
                            Category</a>
                        <a href="{{ route('Category.latest_collections_category') }}"
                            class="block hover:text-pink-500">Latest Collections</a>
                        <a href="{{ route('category.Womens.womens_jewellery') }}"
                            class="block hover:text-pink-500">Women's Jewellery</a>
                        <a href="{{ route('category.mens.mens_jewellery') }}" class="block hover:text-pink-500">Men's
                            Jewellery</a> </a>
                        <a href="#" class="block hover:text-pink-500">More at Shiva Shine</a>
                    </div>
                </div>
            </nav>

        </div>
    </header>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    @include('components.footer')

</body>

</html>

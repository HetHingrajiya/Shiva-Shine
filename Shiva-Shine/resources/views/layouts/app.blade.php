<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Shiva Shine</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Alpine.js -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <style>
        /* Hide Scrollbar */
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }

        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        /* Active link style */
        .active-link {
            background-color: #ffe9f1;
            color: #e11d48; /* Tailwind red-600 */
            font-weight: 600;
        }
    </style>
</head>

<body class="bg-white text-[#633d2e]">

    <!-- Header / Navbar -->
    <nav class="fixed top-0 left-0 w-full z-50 bg-[#fffaf7] shadow-sm border-b border-gray-200" x-data="{ open: false }">
        <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Top Row Mobile -->
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

                <!-- Logo -->
                <a href="{{ url('/') }}" class="block">
                    <img src="{{ asset('images/files/logo.png') }}" alt="Shiva Shine Logo" class="h-12 w-auto">
                </a>

                <!-- Right Icons -->
                @php
                    $navItems = [
                        ['label' => 'Account', 'icon' => 'M12 12a5 5 0 100-10 5 5 0 000 10z M4 22a8 8 0 0116 0', 'link' => route('account.index')],
                    ];
                    if(auth()->check()){
                        $navItems[] = ['label' => 'Wishlist', 'icon' => 'M4.318 6.318a4.5 4.5 0 016.364 0L12 7.636l1.318-1.318a4.5 4.5 0 116.364 6.364L12 21.682l-7.682-8.682a4.5 4.5 0 010-6.364z', 'link' => route('wishlist.index')];
                        $navItems[] = ['label' => 'Cart', 'icon' => 'M3 3h2l.4 2M7 13h10l4-8H5.4 M7 21a1 1 0 100-2 1 1 0 000 2z M20 21a1 1 0 100-2 1 1 0 000 2z', 'link' => route('cart.index')];
                    } else {
                        $navItems[] = ['label'=>'', 'icon'=>'', 'link'=>'javascript:void(0)'];
                        $navItems[] = ['label'=>'', 'icon'=>'', 'link'=>'javascript:void(0)'];
                    }
                @endphp

                <div class="flex space-x-3 text-gray-700">
                    @foreach ($navItems as $item)
                        <a href="{{ $item['link'] }}" class="flex flex-col items-center text-xs hover:text-pink-600 transition">
                            @if($item['icon'])
                                <svg class="w-6 h-6 mb-0.5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path d="{{ $item['icon'] }}" />
                                </svg>
                            @endif
                            <span>{{ $item['label'] }}</span>
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Mobile Search -->
            <div class="sm:hidden mt-2 mb-4">
                <form class="flex bg-white border border-gray-200 rounded-full px-2 py-1 shadow-sm">
                    <input type="text" placeholder="Search..." class="flex-1 px-3 py-2 text-sm outline-none bg-transparent text-gray-700" />
                    <button type="submit" class="p-2 rounded-full bg-pink-500 hover:bg-pink-600">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <circle cx="11" cy="11" r="7" />
                            <line x1="21" y1="21" x2="16.65" y2="16.65" />
                        </svg>
                    </button>
                </form>
            </div>

            <!-- Desktop Header -->
            <div class="hidden sm:flex justify-between items-center h-20">

                <!-- Left: Logo + Location -->
                <div class="flex items-center gap-4">
                    <a href="{{ url('/') }}" class="block">
                        <img src="{{ asset('images/files/logo.png') }}" alt="Shiva Shine Logo" class="h-16 w-auto">
                    </a>
                    <button class="flex bg-[#ffe9f1] text-xs text-gray-700 px-3 py-1.5 rounded-full items-center gap-1.5">
                        <svg class="w-4 h-4 text-pink-500" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 2a6 6 0 00-6 6c0 4.5 6 10 6 10s6-5.5 6-10a6 6 0 00-6-6zm0 8a2 2 0 110-4 2 2 0 010 4z" />
                        </svg>
                        <span>Where to Deliver?</span>
                    </button>
                </div>

                <!-- Center: Search -->
                <div class="hidden md:flex flex-1 max-w-xl mx-6">
                    <form class="w-full flex bg-white border border-gray-200 rounded-full px-2 py-1 shadow-sm">
                        <input type="text" placeholder="Search..." class="flex-1 px-3 py-2 text-sm outline-none bg-transparent text-gray-700" />
                        <button type="submit" class="p-2 rounded-full bg-pink-500 hover:bg-pink-600">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <circle cx="11" cy="11" r="7" />
                                <line x1="21" y1="21" x2="16.65" y2="16.65" />
                            </svg>
                        </button>
                    </form>
                </div>

                <!-- Right Icons -->
                <div class="hidden sm:flex space-x-6 text-sm text-gray-700">
                    @foreach ($navItems as $item)
                        <a href="{{ $item['link'] }}" class="hover:text-pink-500 flex flex-col items-center">
                            @if($item['icon'])
                                <svg class="w-5 h-5 mb-0.5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                    <path d="{{ $item['icon'] }}" />
                                </svg>
                            @endif
                            <span>{{ $item['label'] }}</span>
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Desktop Navigation Buttons -->
            <div class="hidden sm:flex justify-center mt-2 overflow-x-auto scrollbar-hide gap-3 py-2 px-2">
                @php
                    $menuLinks = [
                        ['label' => 'Shop by Category', 'route' => route('Category.all_category'), 'icon' => 'M4 4h16v16H4z', 'name' => 'Category.all_category'],
                        ['label' => 'Latest Collections', 'route' => route('Category.latest_collections_category'), 'icon' => 'M12 2l3 6h6l-5 5 2 7-6-4-6 4 2-7-5-5h6z', 'name' => 'Category.latest_collections_category'],
                        ['label' => 'Women\'s Jewellery', 'route' => route('category.Womens.womens_jewellery'), 'icon' => 'M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z', 'name' => 'category.Womens.womens_jewellery'],
                        ['label' => 'Men\'s Jewellery', 'route' => route('category.mens.mens_jewellery'), 'icon' => 'M12 12c2.21 0 4-1.79 4-4S14.21 4 12 4 8 5.79 8 8s1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z', 'name' => 'category.mens.mens_jewellery'],
                        ['label' => 'More at Shiva Shine', 'route' => route('more'), 'icon' => 'M4 6h16v2H4zm0 5h16v2H4zm0 5h16v2H4z', 'name' => 'more'],
                    ];
                @endphp

                @foreach($menuLinks as $link)
                    <a href="{{ $link['route'] }}"
                       class="flex shadow-md transition px-4 py-2 rounded-xl items-center gap-2 whitespace-nowrap font-medium {{ request()->routeIs($link['name']) ? 'active-link' : 'bg-white text-gray-700 hover:shadow-xl' }}">
                        <svg class="w-5 h-5 text-pink-500" fill="currentColor" viewBox="0 0 24 24">
                            <path d="{{ $link['icon'] }}" />
                        </svg>
                        {{ $link['label'] }}
                    </a>
                @endforeach
            </div>

            <!-- Mobile Dropdown Menu -->
            <div x-show="open" x-transition class="sm:hidden mt-2 px-4 pb-4 space-y-3 text-sm font-medium text-gray-700">
                <!-- Delivery -->
                <button class="w-full flex bg-[#ffe9f1] text-sm text-gray-700 px-4 py-2 rounded-full items-center gap-2 shadow-md hover:shadow-lg transition">
                    <svg class="w-4 h-4 text-pink-500" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 2a6 6 0 00-6 6c0 4.5 6 10 6 10s6-5.5 6-10a6 6 0 00-6-6zm0 8a2 2 0 110-4 2 2 0 010 4z" />
                    </svg>
                    <span>Where to Deliver?</span>
                </button>

                <!-- Menu Links -->
                @foreach($menuLinks as $link)
                    <a href="{{ $link['route'] }}"
                       class="w-full flex px-4 py-2 rounded-xl items-center gap-2 {{ request()->routeIs($link['name']) ? 'active-link' : 'bg-white shadow-md hover:shadow-lg transition' }}">
                        <span>{{ $link['label'] }}</span>
                    </a>
                @endforeach
            </div>

        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    @include('components.footer')

</body>
</html>

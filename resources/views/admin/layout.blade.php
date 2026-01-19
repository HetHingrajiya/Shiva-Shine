<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('page-title', 'Admin') — Shiva Shine</title>

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/feather-icons"></script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-thumb {
            background: rgba(0, 0, 0, 0.15);
            border-radius: 999px;
        }

        .glass {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
        }

        .gold-gradient {
            background: linear-gradient(135deg, #d4af37, #b58e25);
        }
    </style>
</head>

<body class="bg-gray-50 antialiased text-sm">
    <div class="flex h-screen">

        <!-- Sidebar -->
        <aside id="sidebar"
            class="w-72 glass border-r border-gray-200 fixed h-full flex flex-col transition-transform duration-300 z-30 -translate-x-full md:translate-x-0 shadow-lg">

            <!-- Logo row -->
            <div class="h-16 px-6 flex items-center justify-between border-b border-gray-200">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2">
                    <img src="/images/files/logo.png" class="w-28 h-18 object-contain" alt="Logo">
                </a>
                <button id="toggleSidebar" class="md:hidden p-1 rounded hover:bg-gray-100">
                    <i data-feather="x" class="w-5 h-5 text-gray-600"></i>
                </button>
            </div>

            <!-- Sidebar Navigation -->
            <nav class="flex-1 overflow-y-auto py-4 space-y-1">
                @php
                    $links = [
                        ['icon' => 'home', 'label' => 'Dashboard', 'route' => route('admin.dashboard')],
                        [
                            'icon' => 'users',
                            'label' => 'Customers',
                            'route' => route('admin.customers'),
                        ],
                       [
                            'icon'  => 'shopping-cart', // Use a suitable icon from your icon library
                            'label' => 'Orders',
                            'route' => route('admin.orders.index'), // Default route → All Orders
                            'children' => [
                                [
                                    'label' => 'All Orders',
                                    'route' => route('admin.orders.index'),
                                ],
                                [
                                    'label' => 'Pending Orders',
                                    'route' => route('admin.orders.filter', 'pending'),
                                ],
                                [
                                    'label' => 'Processing Orders',
                                    'route' => route('admin.orders.filter', 'processing'),
                                ],
                                [
                                    'label' => 'Completed Orders',
                                    'route' => route('admin.orders.filter', 'completed'),
                                ],
                                [
                                    'label' => 'Cancelled Orders',
                                    'route' => route('admin.orders.filter', 'cancelled'),
                                ],
                            ]
                        ]

                        ,
                        ['icon' => 'box', 'label' => 'Products', 'route' => route('admin.products')],
                        ['icon' => 'tag', 'label' => 'Categories', 'route' => route(name: 'admin.categories')],
                        ['icon' => 'settings', 'label' => 'Settings', 'route' => '#'],
                        ['divider' => true],
                        ['icon' => 'bar-chart-2', 'label' => 'Analytics', 'route' => route('admin.analytics')],
                    ];
                @endphp

                @foreach ($links as $link)
                    @if (!empty($link['divider']))
                        <div class="border-t border-gray-200 my-3"></div>
                    @else
                        <a href="{{ $link['route'] }}"
                            class="flex items-center gap-3 px-6 py-2 rounded-lg hover:bg-gray-100 text-gray-800 font-medium transition">
                            <i data-feather="{{ $link['icon'] }}" class="w-4 h-4"></i>
                            {{ $link['label'] }}
                            @if (!empty($link['badge']))
                                <span class="ml-auto bg-gray-900 text-white text-xs rounded-full px-2 py-0.5">
                                    {{ $link['badge'] }}
                                </span>
                            @endif
                        </a>
                    @endif
                @endforeach
            </nav>


            <!-- Logout -->
            <div class="border-t border-gray-200 p-4">
                <a href="{{ route('admin.logout') }}"
                    class="flex items-center gap-3 px-6 py-2 rounded-lg hover:bg-red-50 text-red-600 font-medium transition">
                    <i data-feather="log-out" class="w-4 h-4"></i> Logout
                </a>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col md:ml-72 transition-all">

            <!-- Topbar -->
            <header
                class="h-16 glass border-b border-gray-200 flex justify-between items-center px-6 sticky top-0 z-20 shadow-sm">
                <div class="flex items-center gap-3">
                    <button id="openSidebar" class="md:hidden p-2 rounded hover:bg-gray-100">
                        <i data-feather="menu" class="w-5 h-5 text-gray-700"></i>
                    </button>
                    <h1 class="text-lg font-semibold text-gray-800">@yield('page-title', 'Dashboard')</h1>
                </div>

                <div class="flex items-center gap-4">
                    <!-- Search -->
                    <div class="relative hidden sm:block">
                        <input type="text" placeholder="Search..."
                            class="pl-10 pr-4 py-2 rounded-full border border-gray-300 focus:ring-2 focus:ring-yellow-500 w-64" />
                        <i data-feather="search" class="absolute left-3 top-2.5 text-gray-400 w-4 h-4"></i>
                    </div>

                    <!-- Notifications -->
                    <div class="relative">
                        <button id="notifBtn" class="relative p-2 rounded-full hover:bg-gray-100">
                            <i data-feather="bell" class="w-5 h-5 text-gray-700"></i>
                            <span
                                class="absolute top-1 right-1 bg-red-500 text-white text-xs rounded-full px-1">3</span>
                        </button>
                        <div id="notifMenu"
                            class="hidden absolute right-0 mt-2 w-72 bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
                            <div class="p-3 text-sm font-semibold text-gray-700 border-b">Notifications</div>
                            <div class="divide-y divide-gray-100">
                                <div class="p-3 text-sm hover:bg-gray-50 cursor-pointer">💎 New order for Diamond
                                    Necklace</div>
                                <div class="p-3 text-sm hover:bg-gray-50 cursor-pointer">👤 New customer registered
                                </div>
                                <div class="p-3 text-sm hover:bg-gray-50 cursor-pointer">📦 Product stock updated</div>
                            </div>
                        </div>
                    </div>

                    <!-- User Menu -->
                    <div class="relative">
                        <button id="userBtn" class="flex items-center gap-2 px-3 py-1 rounded-full hover:bg-gray-100">
                            <img src="https://img.freepik.com/free-vector/business-user-cog_78370-7040.jpg" alt="Admin"
                                class="rounded-full border border-gray-300 w-8 h-8 object-cover">
                            <span class="hidden sm:inline text-gray-700 font-medium">Admin</span>
                            <i data-feather="chevron-down" class="w-4 h-4 text-gray-500"></i>
                        </button>
                        <div id="userMenu"
                            class="hidden absolute right-0 mt-2 w-40 bg-white rounded-lg shadow-lg border border-gray-100">
                            <a href="#" class="block px-4 py-2 hover:bg-gray-50 text-gray-700">Profile</a>
                            <a href="#" class="block px-4 py-2 hover:bg-gray-50 text-gray-700">Settings</a>
                            <a href="{{ route('admin.logout') }}"
                                class="block px-4 py-2 hover:bg-red-50 text-red-600 font-medium">Logout</a>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page content -->
            <main class="p-6 overflow-y-auto">
                @yield('content')
            </main>
        </div>
    </div>

    <script>
        feather.replace();

        const sidebar = document.getElementById('sidebar');
        const openBtn = document.getElementById('openSidebar');
        const closeBtn = document.getElementById('toggleSidebar');
        const notifBtn = document.getElementById('notifBtn');
        const notifMenu = document.getElementById('notifMenu');
        const userBtn = document.getElementById('userBtn');
        const userMenu = document.getElementById('userMenu');

        openBtn?.addEventListener('click', () => sidebar.classList.remove('-translate-x-full'));
        closeBtn?.addEventListener('click', () => sidebar.classList.add('-translate-x-full'));

        notifBtn?.addEventListener('click', e => {
            e.stopPropagation();
            notifMenu.classList.toggle('hidden');
            userMenu.classList.add('hidden');
        });

        userBtn?.addEventListener('click', e => {
            e.stopPropagation();
            userMenu.classList.toggle('hidden');
            notifMenu.classList.add('hidden');
        });

        document.addEventListener('click', () => {
            notifMenu.classList.add('hidden');
            userMenu.classList.add('hidden');
        });

        notifMenu?.addEventListener('click', e => e.stopPropagation());
        userMenu?.addEventListener('click', e => e.stopPropagation());

        window.addEventListener('resize', () => {
            if (window.innerWidth >= 768) sidebar.classList.remove('-translate-x-full');
            else sidebar.classList.add('-translate-x-full');
        });
    </script>
</body>

</html>

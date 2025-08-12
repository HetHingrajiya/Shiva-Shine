<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shiva Shine Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/feather-icons"></script>
</head>

<body class="bg-[#fdf8f6] font-sans">

    <div class="flex h-screen">

        <!-- Sidebar -->
        <aside id="sidebar"
            class="w-64 bg-gradient-to-b from-pink-100 to-pink-200 shadow-lg flex flex-col fixed h-full transition-transform duration-300 z-20">
            <div class="p-3 border-b border-pink-200 flex items-center justify-between bg-white shadow-sm">
                <div class="flex items-center gap-1">
                    <span
                        class="text-transparent bg-clip-text bg-gradient-to-r from-pink-500 via-rose-400 to-pink-600
                     text-xl font-extrabold tracking-wide select-none"
                        style="text-shadow:
                     1px 1px 0px rgba(214, 51, 132, 0.8),
                     2px 2px 3px rgba(0, 0, 0, 0.25),
                     0px 0px 6px rgba(255, 182, 193, 0.7);">
                        ✨ Shiva Shine
                    </span>
                </div>
                <button id="toggleSidebar"
                    class="md:hidden p-1 rounded-full hover:bg-pink-50 active:scale-90 transition duration-200 ease-in-out">
                    <i data-feather="x" class="text-pink-600 w-4 h-4"></i>
                </button>
            </div>




            <nav class="flex-1 p-4 space-y-1">
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded-md hover:bg-pink-50 text-pink-800 hover:text-pink-600 transition active:bg-pink-200">
                    <i data-feather="home"></i><span>Dashboard</span>
                </a>
                <a href="#"
                    class="flex items-center gap-3 px-3 py-2 rounded-md hover:bg-pink-50 text-pink-800 hover:text-pink-600 transition">
                    <i data-feather="users"></i><span>Users</span><span
                        class="ml-auto bg-pink-500 text-white text-xs rounded-full px-2 py-0.5">12</span>
                </a>
                <a href="#"
                    class="flex items-center gap-3 px-3 py-2 rounded-md hover:bg-pink-50 text-pink-800 hover:text-pink-600 transition">
                    <i data-feather="shopping-cart"></i><span>Orders</span>
                </a>
                <!-- NEW Products Link -->
                <a href="{{ route('admin.products') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded-md hover:bg-pink-50 text-pink-800 hover:text-pink-600 transition">
                    <i data-feather="box"></i><span>Products</span>
                </a>
                <a href="#"
                    class="flex items-center gap-3 px-3 py-2 rounded-md hover:bg-pink-50 text-pink-800 hover:text-pink-600 transition">
                    <i data-feather="settings"></i><span>Settings</span>
                </a>
            </nav>


            <div class="p-4 border-t border-pink-300">
                <a href="{{ route('admin.logout') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded-md hover:bg-red-50 text-red-700 transition">
                    <i data-feather="log-out"></i><span>Logout</span>
                </a>
            </div>
        </aside>

        <!-- Main Area -->
        <div class="flex-1 flex flex-col md:ml-64 transition-all">

            <!-- Topbar -->
            <header
                class="bg-white shadow-md flex justify-between items-center px-6 py-3 sticky top-0 z-10 border-b border-gray-200">
                <!-- Sidebar Toggle Button (Mobile) -->
                <button id="openSidebar" class="md:hidden p-2 rounded hover:bg-gray-100">
                    <i data-feather="menu"></i>
                </button>

                <!-- Page Title -->
                <h1 class="text-lg font-semibold text-pink-800">@yield('page-title', 'Dashboard')</h1>

                <!-- Right Section -->
                <div class="flex items-center gap-4">

                    <!-- Search Bar -->
                    <div class="relative hidden sm:block">
                        <input type="text" placeholder="Search..."
                            class="pl-10 pr-4 py-2 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-pink-300 w-64">
                        <i data-feather="search" class="absolute left-3 top-2.5 text-gray-400"></i>
                    </div>

                    <!-- Notifications Dropdown -->
                    <div class="relative">
                        <button id="notifBtn" class="relative p-2 rounded-full hover:bg-pink-50">
                            <i data-feather="bell" class="text-pink-800"></i>
                            <span
                                class="absolute top-1 right-1 bg-red-500 text-white text-xs rounded-full px-1">3</span>
                        </button>
                        <div id="notifMenu"
                            class="hidden absolute right-0 mt-2 w-60 bg-white rounded-lg shadow-lg border border-gray-100 z-50">
                            <div class="p-3 text-sm text-gray-700 font-semibold border-b">Notifications</div>
                            <div class="p-3 text-sm hover:bg-gray-50 cursor-pointer">New order received</div>
                            <div class="p-3 text-sm hover:bg-gray-50 cursor-pointer">User registered</div>
                            <div class="p-3 text-sm hover:bg-gray-50 cursor-pointer">Server maintenance</div>
                        </div>
                    </div>

                    <!-- User Menu -->
                    <div class="relative">
                        <button id="userBtn"
                            class="flex items-center gap-2 cursor-pointer hover:bg-pink-50 px-3 py-1 rounded-full">
                            <img src="https://via.placeholder.com/40" class="rounded-full border border-pink-300">
                            <span class="text-gray-700">Admin</span>
                            <i data-feather="chevron-down" class="text-gray-500"></i>
                        </button>
                        <div id="userMenu"
                            class="hidden absolute right-0 mt-2 w-40 bg-white rounded-lg shadow-lg border border-gray-100 z-50">
                            <a href="#" class="block px-4 py-2 hover:bg-gray-50 text-gray-700">Profile</a>
                            <a href="#" class="block px-4 py-2 hover:bg-gray-50 text-gray-700">Settings</a>
                            <a href="{{ route('admin.logout') }}"
                                class="block px-4 py-2 hover:bg-red-50 text-red-600 font-medium">Logout</a>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="p-6 overflow-y-auto bg-[#fdf8f6] flex-1">
                @yield('content')
            </main>
        </div>
    </div>

    <script>
        feather.replace();

        // Toggle Sidebar Mobile
        const sidebar = document.getElementById('sidebar');
        document.getElementById('openSidebar').addEventListener('click', () => sidebar.classList.remove(
            '-translate-x-full'));
        document.getElementById('toggleSidebar').addEventListener('click', () => sidebar.classList.add(
        '-translate-x-full'));

        // Notifications Dropdown
        document.getElementById('notifBtn').addEventListener('click', () => {
            document.getElementById('notifMenu').classList.toggle('hidden');
        });

        // User Dropdown
        document.getElementById('userBtn').addEventListener('click', () => {
            document.getElementById('userMenu').classList.toggle('hidden');
        });
    </script>

</body>

</html>

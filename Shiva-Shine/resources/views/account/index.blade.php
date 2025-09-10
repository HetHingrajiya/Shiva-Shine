@extends('layouts.app')

@section('content')
<!-- ===== Account Dashboard Section ===== -->
<section class="w-full bg-[#fefcf7] py-16 min-h-screen mt-20">
    <div class="max-w-7xl mx-auto px-4 md:px-6 lg:px-8">
        <h1 class="text-3xl md:text-4xl font-extrabold text-gray-800 mb-10">My Account</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

            <!-- Profile Card -->
            <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition p-6 flex flex-col justify-between">
                <div>
                    <h2 class="text-xl font-semibold text-gray-900 mb-2">Profile Information</h2>
                    <p class="text-gray-600 mb-4">View and update your personal details, such as name, email, and contact number.</p>
                </div>
                <a href="{{ route('profile.index') }}" class="mt-auto inline-block text-white bg-gradient-to-r from-pink-500 to-pink-600 hover:from-pink-600 hover:to-pink-700 text-center py-2 px-4 rounded-lg font-medium transition">
                    Manage Profile
                </a>
            </div>

            <!-- Orders Card -->
            <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition p-6 flex flex-col justify-between">
                <div>
                    <h2 class="text-xl font-semibold text-gray-900 mb-2">My Orders</h2>
                    <p class="text-gray-600 mb-4">Check your past orders and track current shipments easily.</p>
                </div>
                <a href="{{ route('orders.index') }}" class="mt-auto inline-block text-white bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-center py-2 px-4 rounded-lg font-medium transition">
                    View Orders
                </a>
            </div>

            <!-- Wishlist Card -->
            <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition p-6 flex flex-col justify-between">
                <div>
                    <h2 class="text-xl font-semibold text-gray-900 mb-2">Wishlist</h2>
                    <p class="text-gray-600 mb-4">View and manage products you've added to your wishlist.</p>
                </div>
                <a href="{{ route('wishlist.index') }}" class="mt-auto inline-block text-white bg-gradient-to-r from-rose-500 to-rose-600 hover:from-rose-600 hover:to-rose-700 text-center py-2 px-4 rounded-lg font-medium transition">
                    Go to Wishlist
                </a>
            </div>

            <!-- Saved Addresses Card -->
            <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition p-6 flex flex-col justify-between">
                <div>
                    <h2 class="text-xl font-semibold text-gray-900 mb-2">Saved Addresses</h2>
                    <p class="text-gray-600 mb-4">Manage your delivery addresses for faster checkout.</p>
                </div>
                <a href="#" class="mt-auto inline-block text-white bg-gradient-to-r from-indigo-500 to-indigo-600 hover:from-indigo-600 hover:to-indigo-700 text-center py-2 px-4 rounded-lg font-medium transition">
                    Edit Addresses
                </a>
            </div>

            <!-- Change Password Card -->
            <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition p-6 flex flex-col justify-between">
                <div>
                    <h2 class="text-xl font-semibold text-gray-900 mb-2">Change Password</h2>
                    <p class="text-gray-600 mb-4">Update your account password for enhanced security.</p>
                </div>
                <a href="#" class="mt-auto inline-block text-white bg-gradient-to-r from-yellow-500 to-yellow-600 hover:from-yellow-600 hover:to-yellow-700 text-center py-2 px-4 rounded-lg font-medium transition">
                    Change Password
                </a>
            </div>

            <!-- Login / Logout Card -->
            @guest
            <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition p-6 flex flex-col justify-between">
                <div>
                    <h2 class="text-xl font-semibold text-gray-900 mb-2">Login</h2>
                    <p class="text-gray-600 mb-4">Access your account using email/password or Google login.</p>
                </div>
                <a href="{{ route('login') }}" class="mt-auto inline-block text-white bg-gradient-to-r from-pink-500 to-pink-600 hover:from-pink-600 hover:to-pink-700 text-center py-2 px-4 rounded-lg font-medium transition">
                    Login
                </a>
            </div>
            @endguest

            @auth
            <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition p-6 flex flex-col justify-between">
                <div>
                    <h2 class="text-xl font-semibold text-gray-900 mb-2">Logout</h2>
                    <p class="text-gray-600 mb-4">Sign out from your account securely.</p>
                </div>
                <form method="POST" action="{{ route('logout') }}" class="mt-auto">
                    @csrf
                    <button type="submit" class="w-full text-white bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 py-2 px-4 rounded-lg font-medium transition">
                        Logout
                    </button>
                </form>
            </div>
            @endauth

        </div>
    </div>
</section>
@endsection

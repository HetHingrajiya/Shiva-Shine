@extends('layouts.app')

@section('content')
<!-- ===== Account Section ===== -->
<section class="w-full bg-[#fffaf7] py-12 min-h-screen mt-12">
    <div class="max-w-7xl mx-auto px-4">
        <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-8">My Account</h2>

        {{-- Account Information --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            {{-- Profile --}}
            <div class="border rounded-lg overflow-hidden bg-white shadow-sm hover:shadow-md transition">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Profile Information</h3>
                    <p class="text-sm text-gray-600 mb-4">
                        View and update your personal details, such as name, email, and contact number.
                    </p>
                    <a href="#" class="inline-block text-pink-600 hover:text-pink-800 font-medium text-sm">
                        Manage Profile →
                    </a>
                </div>
            </div>

            {{-- Orders --}}
            <div class="border rounded-lg overflow-hidden bg-white shadow-sm hover:shadow-md transition">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">My Orders</h3>
                    <p class="text-sm text-gray-600 mb-4">
                        Check your past orders and track current shipments easily.
                    </p>
                    <a href="#" class="inline-block text-pink-600 hover:text-pink-800 font-medium text-sm">
                        View Orders →
                    </a>
                </div>
            </div>

            {{-- Address --}}
            <div class="border rounded-lg overflow-hidden bg-white shadow-sm hover:shadow-md transition">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Saved Addresses</h3>
                    <p class="text-sm text-gray-600 mb-4">
                        Manage your delivery addresses for faster checkout.
                    </p>
                    <a href="#" class="inline-block text-pink-600 hover:text-pink-800 font-medium text-sm">
                        Edit Addresses →
                    </a>
                </div>
            </div>

            {{-- Wishlist --}}
            <div class="border rounded-lg overflow-hidden bg-white shadow-sm hover:shadow-md transition">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Wishlist</h3>
                    <p class="text-sm text-gray-600 mb-4">
                        View and manage products you've added to your wishlist.
                    </p>
                    <a href="{{ route('wishlist.index') }}" class="inline-block text-pink-600 hover:text-pink-800 font-medium text-sm">
                        Go to Wishlist →
                    </a>
                </div>
            </div>

            {{-- Change Password --}}
            <div class="border rounded-lg overflow-hidden bg-white shadow-sm hover:shadow-md transition">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Change Password</h3>
                    <p class="text-sm text-gray-600 mb-4">
                        Update your account password for enhanced security.
                    </p>
                    <a href="#" class="inline-block text-pink-600 hover:text-pink-800 font-medium text-sm">
                        Change Password →
                    </a>
                </div>
            </div>

            {{-- Logout --}}
            <div class="border rounded-lg overflow-hidden bg-white shadow-sm hover:shadow-md transition">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Logout</h3>
                    <p class="text-sm text-gray-600 mb-4">
                        Sign out from your account securely.
                    </p>
                    <form method="POST" action="#">
                        @csrf
                        <button type="submit" class="text-red-600 hover:text-red-800 font-medium text-sm">
                            Logout →
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

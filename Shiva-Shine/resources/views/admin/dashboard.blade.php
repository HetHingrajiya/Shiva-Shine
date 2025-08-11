@extends('admin.layout')

@section('page-title', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-4 gap-6">
    <!-- Customers -->
    <div class="p-6 rounded-xl bg-gradient-to-r from-blue-500 to-indigo-500 shadow-lg text-white transform hover:scale-105 transition-all duration-300">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-sm font-medium opacity-80">Total Customers</h2>
                <p class="text-3xl font-bold mt-1">1,245</p>
            </div>
            <div class="bg-white/20 p-3 rounded-full">
                <i data-feather="users"></i>
            </div>
        </div>
    </div>

    <!-- Orders -->
    <div class="p-6 rounded-xl bg-gradient-to-r from-green-400 to-emerald-500 shadow-lg text-white transform hover:scale-105 transition-all duration-300">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-sm font-medium opacity-80">Orders</h2>
                <p class="text-3xl font-bold mt-1">320</p>
            </div>
            <div class="bg-white/20 p-3 rounded-full">
                <i data-feather="shopping-cart"></i>
            </div>
        </div>
    </div>

    <!-- Revenue -->
    <div class="p-6 rounded-xl bg-gradient-to-r from-purple-500 to-pink-500 shadow-lg text-white transform hover:scale-105 transition-all duration-300">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-sm font-medium opacity-80">Revenue</h2>
                <p class="text-3xl font-bold mt-1">₹75,000</p>
            </div>
            <div class="bg-white/20 p-3 rounded-full">
                <i data-feather="dollar-sign"></i>
            </div>
        </div>
    </div>

    <!-- Profit Margin -->
    <div class="p-6 rounded-xl bg-gradient-to-r from-yellow-400 to-orange-500 shadow-lg text-white transform hover:scale-105 transition-all duration-300">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-sm font-medium opacity-80">Profit Margin</h2>
                <p class="text-3xl font-bold mt-1">28%</p>
            </div>
            <div class="bg-white/20 p-3 rounded-full">
                <i data-feather="trending-up"></i>
            </div>
        </div>
    </div>
</div>

<!-- Business Insights -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
    <!-- Sales Overview -->
    <div class="bg-white rounded-xl shadow p-6 hover:shadow-xl transition duration-300">
        <h2 class="text-lg font-semibold text-gray-700 flex items-center gap-2">
            <i data-feather="bar-chart-2" class="text-gray-500"></i>
            Sales Overview
        </h2>
        <p class="text-sm text-gray-500 mt-1">Last 30 days performance</p>
        <div class="mt-4">
            <ul class="space-y-3 text-gray-600">
                <li class="flex justify-between">
                    <span>Online Sales</span>
                    <span class="font-semibold">₹45,000</span>
                </li>
                <li class="flex justify-between">
                    <span>Store Sales</span>
                    <span class="font-semibold">₹30,000</span>
                </li>
                <li class="flex justify-between">
                    <span>Total Sales</span>
                    <span class="font-semibold">₹75,000</span>
                </li>
            </ul>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="bg-white rounded-xl shadow p-6 hover:shadow-xl transition duration-300">
        <h2 class="text-lg font-semibold text-gray-700 flex items-center gap-2">
            <i data-feather="activity" class="text-gray-500"></i>
            Recent Activity
        </h2>
        <div class="mt-4 space-y-4">
            <div class="flex items-start gap-3">
                <span class="w-2 h-2 bg-green-500 rounded-full mt-2"></span>
                <div>
                    <p class="text-gray-700">New customer registered</p>
                    <span class="text-xs text-gray-400">5 min ago</span>
                </div>
            </div>
            <div class="flex items-start gap-3">
                <span class="w-2 h-2 bg-blue-500 rounded-full mt-2"></span>
                <div>
                    <p class="text-gray-700">Order #2345 placed</p>
                    <span class="text-xs text-gray-400">20 min ago</span>
                </div>
            </div>
            <div class="flex items-start gap-3">
                <span class="w-2 h-2 bg-yellow-500 rounded-full mt-2"></span>
                <div>
                    <p class="text-gray-700">Payment received</p>
                    <span class="text-xs text-gray-400">1 hour ago</span>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    feather.replace();
</script>
@endsection

@extends('admin.layout')

@section('page-title', 'Dashboard')

@section('content')
@php
    $cards = [
        ['title' => 'Total Customers', 'value' => number_format($totalCustomers), 'icon' => 'users', 'gradient' => 'from-rose-50 to-orange-50'],
        ['title' => 'Orders Today', 'value' => $ordersToday, 'icon' => 'shopping-cart', 'gradient' => 'from-amber-50 to-yellow-50'],
        ['title' => 'Monthly Revenue', 'value' => '₹' . number_format($monthlyRevenue), 'icon' => 'dollar-sign', 'gradient' => 'from-emerald-50 to-green-50'],
        ['title' => 'Profit Margin', 'value' => '₹' . number_format($profitMargin), 'icon' => 'trending-up', 'gradient' => 'from-blue-50 to-sky-50'],
        ['title' => 'New Signups', 'value' => $newSignups, 'icon' => 'user-plus', 'gradient' => 'from-indigo-50 to-purple-50'],
        ['title' => 'Refunds', 'value' => '₹' . number_format($refunds), 'icon' => 'rotate-ccw', 'gradient' => 'from-red-50 to-pink-50'],
        ['title' => 'Avg. Order Value', 'value' => '₹' . number_format($avgOrderValue, 2), 'icon' => 'credit-card', 'gradient' => 'from-lime-50 to-green-50'],
        ['title' => 'Conversion Rate', 'value' => $conversionRate . '%', 'icon' => 'percent', 'gradient' => 'from-teal-50 to-cyan-50'],
        ['title' => 'Pending Orders', 'value' => $pendingOrders, 'icon' => 'clock', 'gradient' => 'from-orange-50 to-yellow-50'],
        ['title' => 'Shipped Orders', 'value' => $shippedOrders, 'icon' => 'truck', 'gradient' => 'from-emerald-50 to-green-50'],
        ['title' => 'Active Products', 'value' => $activeProducts, 'icon' => 'package', 'gradient' => 'from-slate-50 to-gray-50'],
        ['title' => 'Website Visitors', 'value' => number_format($websiteVisitors), 'icon' => 'globe', 'gradient' => 'from-rose-50 to-pink-50'],
    ];
@endphp

<!-- Stats Cards -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
    @foreach($cards as $card)
        <div class="p-6 rounded-2xl bg-gradient-to-r {{ $card['gradient'] }} shadow-md text-gray-800 hover:shadow-lg transform hover:-translate-y-1 transition-all duration-300 border border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-sm font-medium opacity-70 tracking-wide uppercase">{{ $card['title'] }}</h2>
                    <p class="text-2xl font-bold mt-1">{{ $card['value'] }}</p>
                </div>
                <div class="bg-white p-3 rounded-full shadow-sm border border-gray-100">
                    <i data-feather="{{ $card['icon'] }}" class="w-5 h-5 text-gray-600"></i>
                </div>
            </div>
        </div>
    @endforeach
</div>

<!-- Business Insights -->
<div class="grid grid-cols-1 xl:grid-cols-3 gap-6 mt-8">
    <!-- Sales Overview -->
    <div class="bg-gradient-to-b from-white to-neutral-50 rounded-2xl shadow-md border border-gray-200 p-6 hover:shadow-lg transition duration-300">
        <div class="flex items-center gap-2 border-b border-gray-200 pb-3 mb-4">
            <i data-feather="bar-chart-2" class="text-gray-600 w-5 h-5"></i>
            <h2 class="text-lg font-semibold text-gray-900">Sales Overview</h2>
        </div>
        <p class="text-sm text-gray-500 mb-4">Last 30 days performance</p>
        <ul class="space-y-3 text-gray-800">
            <li class="flex justify-between">
                <span>Online Sales</span>
                <span class="font-semibold">₹{{ number_format($sales['online']) }}</span>
            </li>
            <li class="flex justify-between">
                <span>COD Sales</span>
                <span class="font-semibold">₹{{ number_format($sales['cod']) }}</span>
            </li>
            <li class="flex justify-between border-t border-gray-200 pt-3">
                <span>Total Sales</span>
                <span class="font-bold text-emerald-600">₹{{ number_format($sales['online'] + $sales['cod']) }}</span>
            </li>
        </ul>
    </div>

    <!-- Traffic Sources -->
    <div class="bg-gradient-to-b from-white to-neutral-50 rounded-2xl shadow-md border border-gray-200 p-6 hover:shadow-lg transition duration-300">
        <div class="flex items-center gap-2 border-b border-gray-200 pb-3 mb-4">
            <i data-feather="pie-chart" class="text-gray-600 w-5 h-5"></i>
            <h2 class="text-lg font-semibold text-gray-900">Traffic Sources</h2>
        </div>
        <p class="text-sm text-gray-500 mb-4">Where your visitors come from</p>
        <ul class="space-y-3 text-gray-800">
            @foreach($trafficSources as $source)
                <li class="flex justify-between">
                    <span>{{ $source['label'] }}</span>
                    <span class="font-semibold">{{ $source['value'] }}</span>
                </li>
            @endforeach
        </ul>
    </div>

    <!-- Recent Activity -->
    <div class="bg-gradient-to-b from-white to-neutral-50 rounded-2xl shadow-md border border-gray-200 p-6 hover:shadow-lg transition duration-300 flex flex-col">
        <div class="flex items-center gap-2 border-b border-gray-200 pb-3 mb-4">
            <i data-feather="activity" class="text-gray-600 w-5 h-5"></i>
            <h2 class="text-lg font-semibold text-gray-900">Recent Activity</h2>
        </div>
        <div class="mt-4 space-y-5 overflow-y-auto pr-2 max-h-80">
            @forelse($activities as $activity)
                <div class="flex items-start gap-3">
                    <span class="w-2 h-2 {{ $activity['color'] }} rounded-full mt-2"></span>
                    <div>
                        <p class="text-gray-800 font-medium">{{ $activity['text'] }}</p>
                        <span class="text-xs text-gray-500 italic">{{ $activity['time'] }}</span>
                    </div>
                </div>
            @empty
                <p class="text-gray-500 text-sm">No recent activity found.</p>
            @endforelse
        </div>
    </div>
</div>

<script>
    feather.replace();
</script>
@endsection

@extends('admin.layout')

@section('page-title', 'Analytics')

@section('content')
@php
    // You can pass these from AnalyticsController dynamically
    $stats = [
        ['title' => 'Total Sales', 'value' => '₹12,54,320', 'icon' => 'shopping-cart', 'color' => 'bg-emerald-100 text-emerald-600'],
        ['title' => 'New Customers', 'value' => '1,230', 'icon' => 'users', 'color' => 'bg-indigo-100 text-indigo-600'],
        ['title' => 'Refunds', 'value' => '₹25,600', 'icon' => 'rotate-ccw', 'color' => 'bg-red-100 text-red-600'],
        ['title' => 'Website Visitors', 'value' => '54,320', 'icon' => 'globe', 'color' => 'bg-blue-100 text-blue-600'],
    ];

    $traffic = [
        ['label' => 'Organic Search', 'percent' => 42, 'color' => 'bg-emerald-500'],
        ['label' => 'Social Media', 'percent' => 25, 'color' => 'bg-blue-500'],
        ['label' => 'Direct', 'percent' => 18, 'color' => 'bg-indigo-500'],
        ['label' => 'Referral', 'percent' => 15, 'color' => 'bg-orange-500'],
    ];
@endphp

<div class="space-y-8">
    <!-- Header -->
    <div class="flex items-center gap-3 border-b pb-4">
        <i data-feather="bar-chart-2" class="w-6 h-6 text-gray-700"></i>
        <h1 class="text-2xl font-bold text-gray-800">Analytics Overview</h1>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach($stats as $stat)
            <div class="p-6 bg-white rounded-2xl shadow hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300 flex items-center justify-between border border-gray-100">
                <div>
                    <p class="text-sm text-gray-500">{{ $stat['title'] }}</p>
                    <h2 class="text-xl font-bold text-gray-800 mt-1">{{ $stat['value'] }}</h2>
                </div>
                <div class="{{ $stat['color'] }} p-3 rounded-full">
                    <i data-feather="{{ $stat['icon'] }}" class="w-5 h-5"></i>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Charts -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Sales Chart -->
        <div class="bg-white rounded-2xl shadow p-6 border border-gray-100">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Sales Performance</h2>
            <canvas id="salesChart" class="w-full h-64"></canvas>
        </div>

        <!-- Traffic Sources -->
        <div class="bg-white rounded-2xl shadow p-6 border border-gray-100">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Traffic Sources</h2>
            <ul class="space-y-4">
                @foreach($traffic as $source)
                    <li>
                        <div class="flex justify-between mb-1 text-sm font-medium text-gray-700">
                            <span>{{ $source['label'] }}</span>
                            <span>{{ $source['percent'] }}%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                            <div class="{{ $source['color'] }} h-2.5 rounded-full transition-all duration-500 hover:opacity-80"
                                 style="width: {{ $source['percent'] }}%"></div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    feather.replace();

    const ctx = document.getElementById('salesChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{
                label: 'Sales',
                data: [12000, 19000, 15000, 22000, 28000, 32000],
                fill: true,
                borderColor: '#10b981',
                backgroundColor: 'rgba(16,185,129,0.15)',
                tension: 0.4,
                pointBackgroundColor: '#10b981',
                pointRadius: 5,
                pointHoverRadius: 7
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false },
                tooltip: { enabled: true }
            },
            scales: {
                y: { beginAtZero: true, grid: { color: '#f3f4f6' } },
                x: { grid: { color: '#f9fafb' } }
            }
        }
    });
</script>
@endsection

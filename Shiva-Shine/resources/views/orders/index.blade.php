@extends('layouts.app')

@section('content')
<!-- ======= Orders Section ======= -->
<section class="py-16 bg-gradient-to-b from-gray-50 to-white mt-20">
    <div class="max-w-7xl mx-auto px-4">

        <!-- Section Header -->
        <div class="mb-12 text-center">
            <h2 class="text-4xl font-extrabold text-gray-900 tracking-tight">📦 My Orders</h2>
            <p class="text-gray-600 mt-2">Track your past and ongoing orders with detailed insights.</p>
        </div>

        <!-- Orders List -->
        <div class="space-y-10">
            @forelse ($orders as $order)
                <div class="bg-white shadow-lg rounded-2xl border border-gray-200 hover:shadow-2xl transition transform hover:-translate-y-1">

                    @if($order->status === 'cancelled')
                        <!-- Cancelled Order Simple View -->
                        <div class="px-6 py-8 text-center">
                            <span class="px-4 py-1.5 rounded-full text-sm font-semibold bg-red-100 text-red-700">
                                Cancelled
                            </span>
                            <p class="mt-4 text-lg font-bold text-gray-900">
                                This order was cancelled.
                            </p>
                            <p class="mt-1 text-sm text-gray-600">
                                Amount: ₹{{ number_format($order->total_amount, 2) }}
                            </p>
                        </div>
                    @else
                        <!-- Normal Order View -->
                        <!-- Order Header -->
                        <div class="bg-gray-100 px-6 py-4 flex flex-col md:flex-row md:items-center md:justify-between border-b">
                            <div>
                                <h3 class="text-lg font-bold text-gray-900">Order #{{ $order->order_code }}</h3>
                                <p class="text-sm text-gray-500">Placed on {{ $order->created_at->format('d M Y, h:i A') }}</p>
                            </div>
                            <div class="mt-3 md:mt-0 flex items-center gap-5">
                                <span class="px-4 py-1.5 rounded-full text-sm font-semibold
                                    @if($order->status === 'pending') bg-yellow-100 text-yellow-700
                                    @elseif($order->status === 'confirmed') bg-blue-100 text-blue-700
                                    @elseif($order->status === 'processing') bg-purple-100 text-purple-700
                                    @elseif($order->status === 'shipped') bg-indigo-100 text-indigo-700
                                    @elseif($order->status === 'out for delivery') bg-orange-100 text-orange-700
                                    @elseif($order->status === 'delivered') bg-green-100 text-green-700
                                    @endif">
                                    {{ ucfirst($order->status) }}
                                </span>
                                <p class="text-xl font-bold text-gray-900">₹{{ number_format($order->total_amount, 2) }}</p>
                            </div>
                        </div>

                        <!-- Order Body -->
                        <div class="p-6 space-y-8">
                            <!-- Items -->
                            <div class="space-y-5">
                                @foreach($order->items as $item)
                                    <div class="flex items-center justify-between border-b pb-4 group">
                                        <div class="flex items-center gap-4">
                                            <img src="{{ asset('storage/' . $item->product->image1) }}"
                                                 class="w-20 h-20 object-cover rounded-xl border group-hover:scale-105 transition"
                                                 alt="{{ $item->product->name }}">
                                            <div>
                                                <p class="font-semibold text-gray-900">{{ $item->product->name }}</p>
                                                <p class="text-sm text-gray-500">Qty: {{ $item->quantity }}</p>
                                                <p class="text-sm text-gray-500">₹{{ number_format($item->price, 2) }} each</p>
                                            </div>
                                        </div>
                                        <p class="font-bold text-gray-900">
                                            ₹{{ number_format($item->price * $item->quantity, 2) }}
                                        </p>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Progress Tracker -->
                            <div class="relative pt-6">
                                <h4 class="font-semibold text-gray-800 mb-3">🚚 Delivery Status</h4>
                                <div class="flex justify-between items-center relative">

                                    @php
                                        $steps = ['Pending', 'Confirmed', 'Processing', 'Shipped', 'Out for Delivery', 'Delivered'];
                                        $statusIndex = array_search(ucfirst($order->status), $steps);
                                        if ($statusIndex === false) $statusIndex = 0;
                                    @endphp

                                    @foreach($steps as $index => $step)
                                        <div class="flex-1 text-center relative">
                                            <div class="w-10 h-10 mx-auto rounded-full flex items-center justify-center font-bold
                                                {{ $index <= $statusIndex ? 'bg-green-500 text-white' : 'bg-gray-200 text-gray-500' }}">
                                                {{ $index+1 }}
                                            </div>
                                            <p class="text-xs mt-2 font-medium {{ $index <= $statusIndex ? 'text-green-600' : 'text-gray-500' }}">
                                                {{ $step }}
                                            </p>
                                        </div>
                                    @endforeach

                                    <!-- Progress Line -->
                                    <div class="absolute top-5 left-0 right-0 h-1 bg-gray-200">
                                        <div class="h-1 bg-green-500 transition-all duration-500"
                                             style="width: {{ (($statusIndex+1)/count($steps))*100 }}%"></div>
                                    </div>
                                </div>
                                <p class="text-sm text-gray-500 mt-3">
                                    Est. Delivery:
                                    <span class="font-medium text-gray-800">
                                        {{ $order->created_at->addDays(5)->format('d M Y') }}
                                    </span>
                                </p>
                            </div>

                            <!-- Shipping Info -->
                            <div class="grid md:grid-cols-2 gap-6">
                                <div class="bg-gray-50 rounded-xl p-4">
                                    <h4 class="font-semibold text-gray-800 mb-2">📍 Shipping Address</h4>
                                    <p class="text-sm text-gray-600">{{ $order->address }}</p>
                                </div>
                                <div class="bg-gray-50 rounded-xl p-4">
                                    <h4 class="font-semibold text-gray-800 mb-2">💳 Payment</h4>
                                    <p class="text-sm text-gray-600">Method: <span class="font-medium">{{ ucfirst($order->payment_method) }}</span></p>
                                    <p class="text-sm text-gray-600">Total: <span class="font-medium">₹{{ number_format($order->total_amount, 2) }}</span></p>
                                </div>
                            </div>
                        </div>

                        <!-- Order Footer -->
                        <div class="bg-gray-100 px-6 py-4 flex justify-end gap-3 border-t">
                            <a href="{{ route('orders.show', [
                                'encryptedId' => Crypt::encryptString($order->id),
                                'encryptedOrderCode' => Crypt::encryptString($order->order_code)
                            ]) }}"
                           class="px-5 py-2.5 bg-gradient-to-r from-green-500 to-green-600 text-white text-sm font-medium rounded-lg shadow hover:from-green-600 hover:to-green-700 transition">
                            View Details
                        </a>




                            @if(in_array($order->status, ['pending','confirmed']))
                                <!-- Cancel Button with Modal -->
                                <button onclick="openModal({{ $order->id }})" class="px-5 py-2.5 bg-red-100 text-red-700 text-sm font-medium rounded-lg hover:bg-red-200 transition">
                                    Cancel Order
                                </button>

                                <!-- Modal -->
                                <div id="modal-{{ $order->id }}" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center hidden z-50">
                                    <div class="bg-white rounded-xl shadow-lg max-w-md w-full p-6 animate-fadeIn">
                                        <h3 class="text-xl font-bold text-gray-900 mb-4">⚠️ Confirm Cancellation</h3>
                                        <p class="text-gray-600 mb-6">Are you sure you want to cancel this order? This action cannot be undone.</p>
                                        <div class="flex justify-center gap-4">
                                            <form action="{{ route('orders.cancel', $order->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="px-5 py-2.5 bg-red-500 text-white rounded-lg hover:bg-red-600 transition font-medium">
                                                    Yes, Cancel
                                                </button>
                                            </form>
                                            <button onclick="closeModal({{ $order->id }})" class="px-5 py-2.5 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition font-medium">
                                                No, Keep Order
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if($order->status === 'delivered')
                                <form action="{{ route('orders.return', $order->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="px-5 py-2.5 bg-yellow-100 text-yellow-700 text-sm font-medium rounded-lg hover:bg-yellow-200 transition">
                                        Return Order
                                    </button>
                                </form>
                            @endif
                        </div>
                    @endif
                </div>
            @empty
                <!-- Empty State -->
                <div class="text-center py-20 max-w-xl mx-auto">
                    <img src="https://illustrations.popsy.co/gray/shopping-bag.svg" alt="No Orders"
                        class="mx-auto w-56 h-56 object-contain mb-6 opacity-95">
                    <h3 class="text-2xl font-bold text-gray-800 mb-2">No Orders Yet</h3>
                    <p class="text-gray-600">Looks like you haven’t placed any orders. Start shopping today!</p>
                    <a href="{{ route('products.all') }}"
                       class="mt-6 inline-block bg-gradient-to-r from-green-500 to-green-600 text-white px-8 py-3 rounded-xl shadow hover:from-green-600 hover:to-green-700 transition font-semibold">
                        🛍️ Shop Now
                    </a>
                </div>
            @endforelse
        </div>
    </div>
</section>

<script>
    function openModal(orderId) {
        document.getElementById('modal-' + orderId).classList.remove('hidden');
    }
    function closeModal(orderId) {
        document.getElementById('modal-' + orderId).classList.add('hidden');
    }
</script>

<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fadeIn {
        animation: fadeIn 0.3s ease-out forwards;
    }
</style>
@endsection

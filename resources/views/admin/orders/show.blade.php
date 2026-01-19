@extends('admin.layout')

@section('title', 'Order Details')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6">🧾 Order Details</h1>

    <div class="bg-white shadow-lg rounded-xl p-6">
        <!-- Order Header -->
        <div class="flex justify-between items-start mb-6 border-b pb-4">
            <div>
                <p class="text-sm text-gray-500">Order Code</p>
                <h2 class="text-xl font-bold">{{ $order->order_code }}</h2>
                <p class="text-sm text-gray-400">Date: {{ $order->created_at->format('d M Y, H:i') }}</p>
            </div>
            <div>
                <span id="status-badge-{{ $order->id }}" class="px-3 py-1 rounded-full text-white text-sm
                    @if($order->status == 'pending') bg-yellow-500
                    @elseif($order->status == 'processing') bg-blue-500
                    @elseif($order->status == 'completed') bg-green-500
                    @elseif($order->status == 'cancelled') bg-red-500
                    @endif">
                    {{ ucfirst($order->status) }}
                </span>
            </div>
        </div>

        <!-- Customer Info -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <h3 class="font-semibold text-gray-800 mb-2">👤 Customer Info</h3>
                <p><strong>Name:</strong> {{ $order->name ?? $order->user->name ?? 'Guest' }}</p>
                <p><strong>Phone:</strong> {{ $order->phone ?? 'N/A' }}</p>
                <p><strong>Email:</strong> {{ $order->user->email ?? 'N/A' }}</p>
            </div>
            <div>
                <h3 class="font-semibold text-gray-800 mb-2">📍 Delivery Address</h3>
                <p>{{ $order->address }}</p>
            </div>
        </div>

        <!-- Products -->
        <div class="mb-6">
            <h3 class="font-semibold text-gray-800 mb-2">🛍️ Products</h3>
            <div class="space-y-3">
                @foreach($order->items as $item)
                    <div class="flex items-center gap-3 bg-gray-50 p-3 rounded">
                        <img src="{{ $item->product->image1 ? asset('storage/' . $item->product->image1) : 'https://via.placeholder.com/50' }}" class="w-14 h-14 rounded object-cover">
                        <div class="flex-1">
                            <p class="font-medium text-gray-700">{{ $item->product->name }}</p>
                            <p class="text-gray-500 text-sm">₹{{ number_format($item->price, 2) }} × {{ $item->quantity }}</p>
                        </div>
                        <p class="font-semibold">₹{{ number_format($item->price * $item->quantity, 2) }}</p>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Payment & Total -->
        <div class="flex justify-between items-center mb-6">
            <div>
                <p><strong>Payment Method:</strong> {{ ucfirst($order->payment_method) }}</p>
            </div>
            <div>
                <p class="text-lg font-bold">Total: ₹{{ number_format($order->total_amount, 2) }}</p>
            </div>
        </div>

        <!-- Status Update -->
        <div class="mb-6 flex gap-2 items-center">
            <select id="status-select-{{ $order->id }}" class="border rounded px-3 py-2">
                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>
            <button type="button" onclick="updateOrderStatus({{ $order->id }})" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                Update
            </button>
        </div>

        <!-- Actions -->
        <div class="flex gap-3">
            <a href="{{ route('admin.orders.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">⬅ Back</a>
            <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this order?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">🗑 Delete</button>
            </form>
        </div>
    </div>
</div>

<!-- Toast Container -->
<div id="toast-container" class="fixed top-5 right-5 z-50 space-y-2"></div>

<!-- AJAX Script -->
<script>
function showToast(message, type = 'success') {
    const container = document.getElementById('toast-container');
    const toast = document.createElement('div');
    toast.innerText = message;
    toast.className = `
        px-4 py-2 rounded shadow-lg text-white
        ${type === 'success' ? 'bg-green-500' : 'bg-red-500'}
        animate-slide-in
    `;
    container.appendChild(toast);

    // Auto remove after 3 seconds
    setTimeout(() => {
        toast.classList.add('opacity-0', 'transition', 'duration-500');
        setTimeout(() => toast.remove(), 500);
    }, 3000);
}

function updateOrderStatus(orderId) {
    const status = document.getElementById(`status-select-${orderId}`).value;

    fetch(`/admin/orders/${orderId}/status`, {
        method: 'PATCH',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ status: status })
    })
    .then(res => res.json())
    .then(data => {
        if(data.success){
            const badge = document.getElementById(`status-badge-${orderId}`);
            badge.innerText = data.status.charAt(0).toUpperCase() + data.status.slice(1);

            // Change badge color
            badge.className = "px-3 py-1 rounded-full text-white text-sm " +
                (data.status === 'pending' ? 'bg-yellow-500' :
                 data.status === 'processing' ? 'bg-blue-500' :
                 data.status === 'completed' ? 'bg-green-500' :
                 'bg-red-500');

            showToast(`Order status updated to ${data.status}`, 'success');

        } else {
            showToast('Failed to update status.', 'error');
        }
    })
    .catch(err => {
        console.error(err);
        showToast('An error occurred while updating the status.', 'error');
    });
}
</script>

<!-- Toast Animation -->
<style>
@keyframes slide-in {
    0% { transform: translateX(100%); opacity: 0; }
    100% { transform: translateX(0); opacity: 1; }
}
.animate-slide-in {
    animation: slide-in 0.5s ease forwards;
}
</style>
@endsection

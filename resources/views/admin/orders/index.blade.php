@extends('admin.layout')

@section('content')
<div class="mb-6 flex flex-wrap gap-2">
    <a href="{{ route('admin.orders.index') }}" class="px-4 py-2 rounded {{ $filter=='all' ? 'bg-gray-400 text-white' : 'bg-gray-200 hover:bg-gray-300' }}">All</a>
    <a href="{{ route('admin.orders.filter', 'pending') }}" class="px-4 py-2 rounded {{ $filter=='pending' ? 'bg-yellow-500 text-white' : 'bg-yellow-200 hover:bg-yellow-300' }}">Pending</a>
    <a href="{{ route('admin.orders.filter', 'processing') }}" class="px-4 py-2 rounded {{ $filter=='processing' ? 'bg-blue-500 text-white' : 'bg-blue-200 hover:bg-blue-300' }}">Processing</a>
    <a href="{{ route('admin.orders.filter', 'completed') }}" class="px-4 py-2 rounded {{ $filter=='completed' ? 'bg-green-500 text-white' : 'bg-green-200 hover:bg-green-300' }}">Completed</a>
    <a href="{{ route('admin.orders.filter', 'cancelled') }}" class="px-4 py-2 rounded {{ $filter=='cancelled' ? 'bg-red-500 text-white' : 'bg-red-200 hover:bg-red-300' }}">Cancelled</a>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    @forelse($orders as $order)
        <div class="bg-white shadow-lg rounded-xl p-6 hover:shadow-2xl transition duration-300" id="order-card-{{ $order->id }}">
            <!-- Order Header -->
            <div class="flex justify-between items-start mb-4">
                <div>
                    <p class="text-sm text-gray-500">Order ID: <span class="font-semibold">#{{ $order->id }}</span></p>
                    <p class="text-sm text-gray-500">Order Code</p>
                    <h2 class="text-lg font-bold">{{ $order->order_code }}</h2>
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
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4 border-b pb-4">
                <div>
                    <h3 class="font-semibold text-gray-800 mb-2">Customer Info</h3>
                    <p><strong>Name:</strong> {{ $order->name ?? $order->user->name ?? 'Guest' }}</p>
                    <p><strong>Phone:</strong> {{ $order->phone ?? 'N/A' }}</p>
                    <p><strong>Email:</strong> {{ $order->user->email ?? 'N/A' }}</p>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-800 mb-2">Delivery Address</h3>
                    <p>{{ $order->address }}</p>
                </div>
            </div>

            <!-- Products -->
            <div class="mb-4 border-b pb-4">
                <h3 class="font-semibold text-gray-800 mb-2">Products</h3>
                <div class="space-y-2 max-h-40 overflow-y-auto">
                    @foreach($order->items as $item)
                        <div class="flex items-center gap-3 bg-gray-50 p-2 rounded">
                            <img src="{{ $item->product->image1 ? asset('storage/' . $item->product->image1) : 'https://via.placeholder.com/50' }}" class="w-12 h-12 rounded object-cover">
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
            <div class="flex justify-between items-center mb-4">
                <div>
                    <p><strong>Payment Method:</strong> {{ ucfirst($order->payment_method) }}</p>
                </div>
                <div>
                    <p class="text-lg font-bold">Total: ₹{{ number_format($order->total_amount, 2) }}</p>
                </div>
            </div>

            <!-- Status Update & Actions -->
            <div class="flex flex-col md:flex-row gap-2">
                <!-- AJAX Status Update -->
                <form onsubmit="return updateOrderStatus(event, {{ $order->id }})" class="flex-1 flex gap-2">
                    @csrf
                    <select id="status-select-{{ $order->id }}" class="border rounded px-2 py-1 w-full">
                        <option value="pending" {{ $order->status=='pending'?'selected':'' }}>Pending</option>
                        <option value="processing" {{ $order->status=='processing'?'selected':'' }}>Processing</option>
                        <option value="completed" {{ $order->status=='completed'?'selected':'' }}>Completed</option>
                        <option value="cancelled" {{ $order->status=='cancelled'?'selected':'' }}>Cancelled</option>
                    </select>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-1 rounded shadow">Update</button>
                </form>

                <!-- View -->
                <a href="{{ route('admin.orders.show', $order->id) }}" class="flex-1 text-center bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2 rounded shadow">View Details</a>

                <!-- Delete -->
                <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" class="flex-1" onsubmit="return confirm('Are you sure?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded shadow">Delete</button>
                </form>
            </div>
        </div>
    @empty
        <p class="col-span-full text-center text-gray-500 mt-10">No orders found.</p>
    @endforelse
</div>

<!-- Toast Container -->
<div id="toast-container" class="fixed top-5 right-5 z-50 space-y-2"></div>

<!-- AJAX Script -->
<script>
function showToast(message, type='success') {
    const container = document.getElementById('toast-container');
    const toast = document.createElement('div');
    toast.innerText = message;
    toast.className = `
        px-4 py-2 rounded shadow-lg text-white
        ${type==='success' ? 'bg-green-500' : 'bg-red-500'}
        animate-slide-in
    `;
    container.appendChild(toast);

    // Auto-remove after 3s
    setTimeout(() => {
        toast.classList.add('opacity-0', 'transition', 'duration-500');
        setTimeout(() => toast.remove(), 500);
    }, 3000);
}

function updateOrderStatus(event, orderId) {
    event.preventDefault();
    let status = document.getElementById(`status-select-${orderId}`).value;

    fetch(`/admin/orders/${orderId}/status`, {
        method: "PATCH",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify({ status: status })
    })
    .then(res => res.json())
    .then(data => {
        if(data.success){
            let badge = document.getElementById(`status-badge-${orderId}`);
            badge.innerText = status.charAt(0).toUpperCase() + status.slice(1);
            badge.className = "px-3 py-1 rounded-full text-white text-sm " +
                (status === 'pending' ? 'bg-yellow-500' :
                 status === 'processing' ? 'bg-blue-500' :
                 status === 'completed' ? 'bg-green-500' :
                 'bg-red-500');

            showToast(`Order status updated to ${status}`, 'success');

            // 🔄 Reload page after 1 second so toast is visible
            setTimeout(() => {
                location.reload();
            }, 1000);

        } else {
            showToast('Failed to update status', 'error');
        }
    })
    .catch(() => showToast('Error updating order status', 'error'));
}
</script>


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

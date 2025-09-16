@extends('admin.layout')

@section('page-title', 'Customers')

@section('content')
<div class="bg-white shadow rounded-lg p-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-lg font-semibold text-gray-800">Customer List</h2>

        <!-- 🔎 Search Bar -->
        <form method="GET" action="{{ route('admin.customers') }}" class="flex items-center space-x-2">
            <input type="text" name="search" value="{{ request('search') }}"
                placeholder="Search customers..."
                class="w-64 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">

            @if(request('search'))
                <a href="{{ route('admin.customers') }}"
                   class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition text-sm">
                    Cancel
                </a>
            @else
                <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition text-sm">
                    Search
                </button>
            @endif
        </form>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full border border-gray-200 rounded-lg overflow-hidden">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">#</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Name</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Email</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Phone</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Joined On</th>
                    <th class="px-4 py-2 text-right text-sm font-semibold text-gray-700">Actions</th>
                </tr>
            </thead>
            <tbody id="customerTableBody">
                @forelse($customers as $customer)
                <tr id="row-{{ $customer->id }}" class="border-t hover:bg-gray-50">
                    <td class="px-4 py-2">
                        {{ $loop->iteration + ($customers->currentPage() - 1) * $customers->perPage() }}
                    </td>
                    <td class="px-4 py-2 font-medium" id="name-{{ $customer->id }}">{{ $customer->name }}</td>
                    <td class="px-4 py-2" id="email-{{ $customer->id }}">{{ $customer->email }}</td>
                    <td class="px-4 py-2" id="phone-{{ $customer->id }}">{{ $customer->phone ?? '—' }}</td>
                    <td class="px-4 py-2">{{ $customer->created_at->format('d M Y') }}</td>
                    <td class="px-4 py-2 text-right space-x-2">
                        <!-- Edit Button -->
                        <button onclick="openEditModal({{ $customer->id }}, '{{ $customer->name }}', '{{ $customer->email }}', '{{ $customer->phone }}')"
                           class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600 text-sm">
                            Edit
                        </button>

                        <!-- Delete -->
                        <form action="{{ route('admin.customers.destroy', $customer->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                               onclick="return confirm('Are you sure you want to delete this customer?')"
                               class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700 text-sm">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-4 py-4 text-center text-gray-500">
                        No customers found.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $customers->appends(['search' => request('search')])->links('pagination::tailwind') }}
    </div>
</div>

<!-- 🔧 Edit Customer Modal -->
<div id="editModal" class="fixed inset-0 hidden bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
        <h2 class="text-lg font-semibold mb-4">Edit Customer</h2>

        <form id="editForm">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" id="editName" name="name" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="mb-3">
                <label class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" id="editEmail" name="email" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="mb-3">
                <label class="block text-sm font-medium text-gray-700">Phone</label>
                <input type="text" id="editPhone" name="phone" maxlength="10" pattern="[0-9]{10}"
                       class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="flex justify-end space-x-2">
                <button type="button" onclick="closeEditModal()" class="px-4 py-2 bg-gray-500 text-white rounded-lg">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg">Update</button>
            </div>
        </form>
    </div>
</div>

<script>
    let customerId = null;

    function openEditModal(id, name, email, phone) {
        customerId = id;
        document.getElementById('editModal').classList.remove('hidden');
        document.getElementById('editName').value = name;
        document.getElementById('editEmail').value = email;
        document.getElementById('editPhone').value = phone;
    }

    function closeEditModal() {
        document.getElementById('editModal').classList.add('hidden');
    }

    // 🔄 Handle AJAX Update
    document.getElementById('editForm').addEventListener('submit', function (e) {
        e.preventDefault();

        let formData = {
            name: document.getElementById('editName').value,
            email: document.getElementById('editEmail').value,
            phone: document.getElementById('editPhone').value,
            _token: "{{ csrf_token() }}",
            _method: "PUT"
        };

        fetch(`/admin/customers/${customerId}`, {
            method: "POST", // Laravel requires POST with _method=PUT
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify(formData)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // ✅ Update row in table
                document.getElementById('name-' + customerId).innerText = data.customer.name;
                document.getElementById('email-' + customerId).innerText = data.customer.email;
                document.getElementById('phone-' + customerId).innerText = data.customer.phone;

                closeEditModal();
                alert("Customer updated successfully!");
            } else {
                alert("Failed to update customer!");
            }
        })
        .catch(error => {
            console.error("Error:", error);
            alert("Something went wrong!");
        });
    });
</script>
@endsection

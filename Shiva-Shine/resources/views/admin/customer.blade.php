@extends('admin.layout')

@section('page-title', 'Customers')

@section('content')
<div class="bg-white shadow rounded-lg p-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-lg font-semibold text-gray-800">Customer List</h2>

        <!-- 🔎 Search Bar with Cancel -->
        <form method="GET" action="{{ route('admin.customers') }}" class="flex items-center space-x-2">
            <input type="text" name="search" value="{{ request('search') }}"
                placeholder="Search customers..."
                class="w-64 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm">

            @if(request('search'))
                <!-- Show Cancel button if search is active -->
                <a href="{{ route('admin.customers') }}"
                   class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition text-sm">
                    Cancel
                </a>
            @else
                <!-- Show Search button if no search query -->
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
            <tbody>
                @forelse($customers as $customer)
                <tr class="border-t hover:bg-gray-50">
                    <td class="px-4 py-2">{{ $loop->iteration + ($customers->currentPage() - 1) * $customers->perPage() }}</td>
                    <td class="px-4 py-2 font-medium">{{ $customer['name'] }}</td>
                    <td class="px-4 py-2">{{ $customer['email'] }}</td>
                    <td class="px-4 py-2">{{ $customer['phone'] }}</td>
                    <td class="px-4 py-2">{{ \Carbon\Carbon::parse($customer['joined_on'])->format('d M Y') }}</td>
                    <td class="px-4 py-2 text-right space-x-2">
                        <a href="#"
                           class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600 text-sm">
                            Edit
                        </a>
                        <a href="#"
                           class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700 text-sm">
                            Delete
                        </a>
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
@endsection

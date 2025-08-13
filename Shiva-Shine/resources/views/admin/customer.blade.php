@extends('admin.layout')

@section('page-title', 'Customers')

@section('content')
<div class="bg-white shadow rounded-lg p-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-lg font-semibold text-gray-800">Customer List</h2>
        <a href="#"
           class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
            Add Customer
        </a>
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
                <tr class="border-t hover:bg-gray-50">
                    <td class="px-4 py-2">1</td>
                    <td class="px-4 py-2 font-medium">John Doe</td>
                    <td class="px-4 py-2">john@example.com</td>
                    <td class="px-4 py-2">+1 555 123 456</td>
                    <td class="px-4 py-2">01 Jan 2025</td>
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
                <tr class="border-t hover:bg-gray-50">
                    <td class="px-4 py-2">2</td>
                    <td class="px-4 py-2 font-medium">Jane Smith</td>
                    <td class="px-4 py-2">jane@example.com</td>
                    <td class="px-4 py-2">+1 555 987 654</td>
                    <td class="px-4 py-2">05 Jan 2025</td>
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
                <tr class="border-t hover:bg-gray-50">
                    <td class="px-4 py-2">3</td>
                    <td class="px-4 py-2 font-medium">Alice Brown</td>
                    <td class="px-4 py-2">alice@example.com</td>
                    <td class="px-4 py-2">+1 555 555 555</td>
                    <td class="px-4 py-2">10 Jan 2025</td>
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
            </tbody>
        </table>
    </div>
</div>
@endsection

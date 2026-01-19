<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        // 🔎 Search filter (by name, email, or phone)
        if ($search = $request->get('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        // 🔹 Paginate (12 per page)
        $customers = $query->orderBy('created_at', 'desc')->paginate(12);

        return view('admin.customers.index', compact('customers'));
    }

    public function update(Request $request, $id)
    {
        $customer = User::findOrFail($id);

        $request->validate([
            'name'  => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,' . $customer->id,
            'phone' => 'nullable|digits:10', // ✅ enforce 10 digit phone
        ]);

        $customer->update($request->only('name', 'email', 'phone'));

        // 🔄 Return JSON for AJAX
        return response()->json([
            'success'  => true,
            'message'  => '✅ Customer updated successfully.',
            'customer' => $customer
        ]);
    }

    public function destroy($id)
    {
        $customer = User::findOrFail($id);
        $customer->delete();

        // Return JSON for AJAX delete (optional)
        return response()->json([
            'success' => true,
            'message' => '🗑️ Customer deleted successfully.'
        ]);
    }
}

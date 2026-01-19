<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class AdminOrderController extends Controller
{
    // Show all orders
    public function index()
    {
        $orders = Order::with('items.product', 'user')
            ->orderBy('created_at', 'asc')
            ->get();

        return view('admin.orders.index', [
            'orders' => $orders,
            'filter' => 'all'
        ]);
    }

    // Show single order
    public function show($id)
    {
        $order = Order::with('items.product', 'user')->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    // Delete order
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->items()->delete(); // remove related items
        $order->delete();

        return redirect()->route('admin.orders.index')
            ->with('success', 'Order deleted successfully.');
    }

    // Update order statuspublic function updateStatus(Request $request, $id)// AdminOrderController.php
        public function updateStatus(Request $request, $id)
        {
            $request->validate([
                'status' => 'required|in:pending,processing,completed,cancelled',
            ]);

            $order = Order::findOrFail($id);
            $order->status = $request->status;
            $order->save();

            return response()->json(['success' => true, 'status' => $order->status]);
        }


            // Generic filter for orders by status
    public function filter($status)
    {
        $validStatuses = ['pending', 'processing', 'completed', 'cancelled'];

        if (!in_array($status, $validStatuses)) {
            abort(404); // Invalid status → show 404
        }

        $orders = Order::where('status', $status)
            ->with('items.product', 'user')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.orders.index', [
            'orders' => $orders,
            'filter' => $status
        ]);
    }
}

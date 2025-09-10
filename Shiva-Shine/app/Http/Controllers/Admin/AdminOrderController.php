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
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.orders.index', compact('orders'));
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

        return redirect()->route('admin.orders.index')->with('success', 'Order deleted successfully.');
    }

    // Update order status
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled',
        ]);

        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        return redirect()->back()->with('success', 'Order status updated successfully.');
    }

    // Filter orders by status
    public function pending()
    {
        $orders = Order::where('status', 'pending')->with('items.product', 'user')->get();
        return view('admin.orders.index', compact('orders'));
    }

    public function completed()
    {
        $orders = Order::where('status', 'completed')->with('items.product', 'user')->get();
        return view('admin.orders.index', compact('orders'));
    }

    public function cancelled()
    {
        $orders = Order::where('status', 'cancelled')->with('items.product', 'user')->get();
        return view('admin.orders.index', compact('orders'));
    }
}

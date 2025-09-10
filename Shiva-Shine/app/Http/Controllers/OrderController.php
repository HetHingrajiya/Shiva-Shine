<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use App\Models\Order;

class OrderController extends Controller
{
    /**
     * Show all user orders
     */
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('orders.index', compact('orders'));
    }

    /**
     * Show single order details
     */
    public function show($encryptedOrderCode)
    {
        try {
            $orderCode = Crypt::decryptString($encryptedOrderCode);

            $order = Order::with('items.product')
                ->where('user_id', Auth::id())
                ->where('order_code', $orderCode)
                ->firstOrFail();

            return view('orders.show', compact('order'));
        } catch (\Exception $e) {
            return redirect()->route('orders.index')->with('error', '⚠️ Invalid or expired order link.');
        }
    }

    /**
     * Cancel order
     */
    public function cancel($id)
    {
        $order = Order::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        // Only allow cancel if still pending/confirmed
        if (!in_array($order->status, ['pending', 'confirmed'])) {
            return redirect()->back()->with('error', '❌ Order cannot be cancelled now.');
        }

        $order->status = 'cancelled';
        $order->save();

        return redirect()->back()->with('success', '✅ Order cancelled successfully.');
    }

    /**
     * Return order
     */
    public function return($id)
    {
        $order = Order::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        // Only allow return if delivered
        if ($order->status !== 'completed') {
            return redirect()->back()->with('error', '❌ Only delivered orders can be returned.');
        }

        $order->status = 'returned';
        $order->save();

        return redirect()->back()->with('success', '🔄 Return request placed successfully.');
    }
}

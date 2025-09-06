<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;

class CheckoutController extends Controller
{
    /**
     * Show checkout page
     */
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to continue checkout.');
        }

        $cartItems = Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $total = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);

        return view('checkout.index', compact('cartItems', 'total'));
    }

    /**
     * Place an order
     */
    public function placeOrder(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to place order.');
        }

        $request->validate([
            'address' => 'required|string|max:255',
            'payment_method' => 'required|string|in:cod,online'
        ]);

        $cartItems = Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $total = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);

        // ✅ Create Order
        $order = Order::create([
            'user_id'       => Auth::id(),
            'address'       => $request->address,
            'payment_method'=> $request->payment_method,
            'total_amount'  => $total,
            'status'        => 'pending',
        ]);

        // ✅ Save Order Items
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id'  => $order->id,
                'product_id'=> $item->product_id,
                'quantity'  => $item->quantity,
                'price'     => $item->product->price,
            ]);
        }

        // ✅ Clear user cart
        Cart::where('user_id', Auth::id())->delete();

        // Redirect to success page
        return redirect()->route('checkout.success', $order->id)
            ->with('success', 'Order placed successfully!');
    }

    /**
     * Order success page
     */
    public function success($orderId)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $order = Order::with('items.product')
            ->where('id', $orderId)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view('checkout.success', compact('order'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Support\Str;

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
     * Place order
     */
    public function placeOrder(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to place order.');
        }

        // ✅ Validate inputs
        $request->validate([
            'address'        => 'required|string|max:255',
            'payment_method' => 'required|string|in:cod,online',
        ]);

        $cartItems = Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $total = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);

        DB::beginTransaction();
        try {
            // ✅ Generate unique order code (8–10 characters)
            $orderCode = 'ORD-' . strtoupper(Str::random(8));

            while (Order::where('order_code', $orderCode)->exists()) {
                $orderCode = 'ORD-' . strtoupper(Str::random(8));
            }

            // ✅ Create Order
            $order = Order::create([
                'user_id'        => Auth::id(),
                'order_code'     => $orderCode,
                'address'        => $request->address,
                'payment_method' => $request->payment_method,
                'total_amount'   => $total,
                'status'         => 'pending',
            ]);

            // ✅ Add Order Items
            foreach ($cartItems as $item) {
                $order->items()->create([
                    'product_id' => $item->product_id,
                    'quantity'   => $item->quantity,
                    'price'      => $item->product->price,
                ]);
            }

            // ✅ Clear Cart
            Cart::where('user_id', Auth::id())->delete();

            DB::commit();

            // ✅ Redirect with order_code (not ID)
            return redirect()->route('checkout.success', $order->order_code)
                ->with('success', '🎉 Order placed successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('checkout.index')
                ->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    /**
     * Success page
     */
    public function success($orderCode)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $order = Order::with('items.product')
            ->where('order_code', $orderCode)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view('checkout.success', compact('order'));
    }
}

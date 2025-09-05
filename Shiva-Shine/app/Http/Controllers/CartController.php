<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to view your cart.');
        }

        $cartItems = Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();

        return view('cart.index', compact('cartItems'));
    }

    public function add(Request $request)
    {
        if (!Auth::check()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Please login to add items to the cart.'
            ]);
        }

        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'nullable|integer|min:1'
        ]);

        $productId = $request->product_id;
        $quantity = $request->quantity ?? 1;

        Cart::updateOrCreate(
            ['user_id' => Auth::id(), 'product_id' => $productId],
            ['quantity' => \DB::raw("quantity + $quantity")]
        );

        return response()->json([
            'status' => 'success',
            'message' => 'Product added to cart',
            'cart_count' => Cart::where('user_id', Auth::id())->count()
        ]);
    }

    public function remove(Request $request)
    {
        if (!Auth::check()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Please login to remove items from the cart.'
            ]);
        }

        $request->validate(['product_id' => 'required|exists:carts,product_id']);

        Cart::where('user_id', Auth::id())
            ->where('product_id', $request->product_id)
            ->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Product removed from cart',
            'cart_count' => Cart::where('user_id', Auth::id())->count()
        ]);
    }

    public function update(Request $request)
    {
        if (!Auth::check()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Please login to update the cart.'
            ]);
        }

        $request->validate([
            'product_id' => 'required|exists:carts,product_id',
            'quantity' => 'required|integer|min:1'
        ]);

        $cart = Cart::where('user_id', Auth::id())
            ->where('product_id', $request->product_id)
            ->first();

        if ($cart) {
            $cart->update(['quantity' => $request->quantity]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Cart updated'
        ]);
    }
}

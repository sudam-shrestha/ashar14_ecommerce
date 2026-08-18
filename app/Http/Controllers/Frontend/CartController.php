<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends BaseController
{
    public function index()
    {
        $carts = Cart::with(['product', 'dokan'])
            ->where('user_id', Auth::id())
            ->get();

        $groupedCarts = $carts->groupBy('dokan_id');
        $totalItems = $carts->sum('qty');
        $subtotal = $carts->sum(function ($item) {
            $price = $item->product->discount > 0
                ? $item->product->price - ($item->product->price * $item->product->discount / 100)
                : $item->product->price;
            return $price * $item->qty;
        });

        return view('frontend.cart', compact('carts', 'groupedCarts', 'totalItems', 'subtotal'));
    }

    public function add(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to add items to cart.');
        }

        $request->validate([
            'product_id' => 'required|exists:products,id',
            'qty' => 'required|integer|min:1'
        ]);

        $product = Product::findOrFail($request->product_id);

        $existingCart = Cart::where('user_id', Auth::id())
            ->where('product_id', $request->product_id)
            ->first();

        if ($existingCart) {
            $existingCart->update([
                'qty' => $existingCart->qty + $request->qty
            ]);
            $message = 'Product quantity updated in cart!';
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $request->product_id,
                'dokan_id' => $product->dokan_id,
                'qty' => $request->qty
            ]);
            $message = 'Product added to cart successfully!';
        }

        return redirect()->route('cart.index')->with('success', $message);
    }

    public function update(Request $request)
    {
        $request->validate([
            'cart_id' => 'required|exists:carts,id',
            'qty' => 'required|integer|min:1'
        ]);

        $cart = Cart::where('id', $request->cart_id)
            ->where('user_id', Auth::id())
            ->first();

        if ($cart) {
            $cart->update(['qty' => $request->qty]);
        }

        return redirect()->route('cart.index')->with('success', 'Cart updated successfully!');
    }

    public function remove(Request $request)
    {
        $request->validate([
            'cart_id' => 'required|exists:carts,id'
        ]);

        $cart = Cart::where('id', $request->cart_id)
            ->where('user_id', Auth::id())
            ->first();

        if ($cart) {
            $cart->delete();
        }

        return redirect()->route('cart.index')->with('success', 'Item removed from cart!');
    }

    public function clear(Request $request)
    {
        Cart::where('user_id', Auth::id())->delete();
        return redirect()->route('cart.index')->with('success', 'Cart cleared successfully!');
    }

    public function getCount()
    {
        if (!Auth::check()) {
            return response()->json(['count' => 0]);
        }

        $count = Cart::where('user_id', Auth::id())->sum('qty');
        return response()->json(['count' => $count]);
    }
}

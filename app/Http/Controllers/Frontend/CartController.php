<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display the cart page with items grouped by vendor
     */
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to view your cart.');
        }

        $carts = Cart::with(['product', 'dokan'])
            ->where('user_id', Auth::id())
            ->get();

        // Group cart items by dokan_id
        $groupedCarts = $carts->groupBy('dokan_id');

        // Calculate cart totals
        $totalItems = $carts->sum('qty');
        $subtotal = $carts->sum(function ($item) {
            $price = $item->product->discount > 0
                ? $item->product->price - ($item->product->price * $item->product->discount / 100)
                : $item->product->price;
            return $price * $item->qty;
        });

        return view('frontend.cart', compact('carts', 'groupedCarts', 'totalItems', 'subtotal'));
    }

    /**
     * Add a product to cart
     */
    public function add(Request $request)
    {
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Please login to add items to cart.',
                'redirect' => route('login')
            ], 401);
        }

        $request->validate([
            'product_id' => 'required|exists:products,id',
            'qty' => 'required|integer|min:1'
        ]);

        $product = Product::findOrFail($request->product_id);

        // Check if product already in cart
        $existingCart = Cart::where('user_id', Auth::id())
            ->where('product_id', $request->product_id)
            ->first();

        if ($existingCart) {
            // Update quantity
            $existingCart->update([
                'qty' => $existingCart->qty + $request->qty
            ]);
            $message = 'Product quantity updated in cart!';
        } else {
            // Create new cart item
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $request->product_id,
                'dokan_id' => $product->dokan_id,
                'qty' => $request->qty
            ]);
            $message = 'Product added to cart successfully!';
        }

        // Get updated cart count
        $cartCount = Cart::where('user_id', Auth::id())->sum('qty');

        return response()->json([
            'success' => true,
            'message' => $message,
            'cart_count' => $cartCount
        ]);
    }

    /**
     * Update cart item quantity
     */
    public function update(Request $request)
    {
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Please login to update your cart.'
            ], 401);
        }

        $request->validate([
            'cart_id' => 'required|exists:carts,id',
            'qty' => 'required|integer|min:1'
        ]);

        $cart = Cart::where('id', $request->cart_id)
            ->where('user_id', Auth::id())
            ->first();

        if (!$cart) {
            return response()->json([
                'success' => false,
                'message' => 'Cart item not found.'
            ], 404);
        }

        $cart->update(['qty' => $request->qty]);

        // Recalculate totals
        $carts = Cart::where('user_id', Auth::id())->get();
        $subtotal = $carts->sum(function ($item) {
            $price = $item->product->discount > 0
                ? $item->product->price - ($item->product->price * $item->product->discount / 100)
                : $item->product->price;
            return $price * $item->qty;
        });
        $totalItems = $carts->sum('qty');

        // Calculate item total
        $itemPrice = $cart->product->discount > 0
            ? $cart->product->price - ($cart->product->price * $cart->product->discount / 100)
            : $cart->product->price;
        $itemTotal = $itemPrice * $cart->qty;

        return response()->json([
            'success' => true,
            'message' => 'Cart updated successfully!',
            'item_total' => number_format($itemTotal, 2),
            'item_price' => number_format($itemPrice, 2),
            'subtotal' => number_format($subtotal, 2),
            'total_items' => $totalItems,
            'cart_count' => $totalItems
        ]);
    }

    /**
     * Remove item from cart
     */
    public function remove(Request $request)
    {
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Please login to remove items from cart.'
            ], 401);
        }

        $request->validate([
            'cart_id' => 'required|exists:carts,id'
        ]);

        $cart = Cart::where('id', $request->cart_id)
            ->where('user_id', Auth::id())
            ->first();

        if (!$cart) {
            return response()->json([
                'success' => false,
                'message' => 'Cart item not found.'
            ], 404);
        }

        $cart->delete();

        // Recalculate totals
        $carts = Cart::where('user_id', Auth::id())->get();
        $subtotal = $carts->sum(function ($item) {
            $price = $item->product->discount > 0
                ? $item->product->price - ($item->product->price * $item->product->discount / 100)
                : $item->product->price;
            return $price * $item->qty;
        });
        $totalItems = $carts->sum('qty');

        return response()->json([
            'success' => true,
            'message' => 'Item removed from cart!',
            'subtotal' => number_format($subtotal, 2),
            'total_items' => $totalItems,
            'cart_count' => $totalItems,
            'dokan_id' => $cart->dokan_id
        ]);
    }

    /**
     * Clear all items from cart
     */
    public function clear(Request $request)
    {
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Please login to clear your cart.'
            ], 401);
        }

        Cart::where('user_id', Auth::id())->delete();

        return response()->json([
            'success' => true,
            'message' => 'Cart cleared successfully!',
            'cart_count' => 0
        ]);
    }

    /**
     * Get cart count for header
     */
    public function getCount()
    {
        if (!Auth::check()) {
            return response()->json(['count' => 0]);
        }

        $count = Cart::where('user_id', Auth::id())->sum('qty');
        return response()->json(['count' => $count]);
    }
}

<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class OrderController extends BaseController
{
    /**
     * Show checkout page for selected vendor
     */
    public function checkout(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to checkout.');
        }

        $dokanId = $request->dokan_id;
        if (!$dokanId) {
            return redirect()->route('cart.index')->with('error', 'Please select a vendor to checkout.');
        }

        // Get cart items for the selected vendor
        $cartItems = Cart::with(['product', 'dokan'])
            ->where('user_id', Auth::id())
            ->where('dokan_id', $dokanId)
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'No items found for this vendor.');
        }

        // Calculate totals
        $subtotal = $cartItems->sum(function ($item) {
            $price = $item->product->discount > 0
                ? $item->product->price - ($item->product->price * $item->product->discount / 100)
                : $item->product->price;
            return $price * $item->qty;
        });

        $dokan = $cartItems->first()->dokan;
        $totalItems = $cartItems->sum('qty');

        return view('frontend.checkout', compact('cartItems', 'dokan', 'subtotal', 'totalItems', 'dokanId'));
    }

    /**
     * Process order with COD or Khalti payment
     */
    public function placeOrder(Request $request)
    {
        // return $request;
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to place order.');
        }

        $request->validate([
            'dokan_id' => 'required|exists:dokans,id',
            'payment_method' => 'required|in:cod,khalti'
        ]);

        try {
            DB::beginTransaction();

            // Get cart items for the selected vendor
            $cartItems = Cart::with('product')
                ->where('user_id', Auth::id())
                ->where('dokan_id', $request->dokan_id)
                ->get();

            if ($cartItems->isEmpty()) {
                return redirect()->route('cart.index')->with('error', 'No items found for this vendor.');
            }

            // Calculate total amount
            $totalAmount = $cartItems->sum(function ($item) {
                $price = $item->product->discount > 0
                    ? $item->product->price - ($item->product->price * $item->product->discount / 100)
                    : $item->product->price;
                return $price * $item->qty;
            });

            // Create order
            $order = Order::create([
                'user_id' => Auth::id(),
                'dokan_id' => $request->dokan_id,
                'total_amount' => $totalAmount,
                'status' => 'pending',
                'payment_method' => $request->payment_method,
                'payment_status' => false,
            ]);

            // Create order items
            foreach ($cartItems as $cartItem) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $cartItem->product_id,
                    'qty' => $cartItem->qty,
                ]);
            }

            // Clear cart items for this vendor only
            Cart::where('user_id', Auth::id())
                ->where('dokan_id', $request->dokan_id)
                ->delete();

            // If COD, commit and redirect to success
            if ($request->payment_method === 'cod') {
                DB::commit();
                return redirect()->route('order.success', $order->id)
                    ->with('success', 'Order placed successfully!');
            }

            // Khalti Payment Integration
            $url = env('KHALTI_BASEURL') . "epayment/initiate/";

            $response = Http::withHeaders([
                "Authorization" => "Key " . env('KHALTI_SECRET')
            ])->post($url, [
                "return_url" => route('khalti.callback'),
                "website_url" => env('APP_URL'),
                "amount" => $totalAmount * 100,
                "purchase_order_id" => $order->id,
                "purchase_order_name" => "Order #" . $order->id,
                "customer_info" => [
                    "name" => Auth::user()->name,
                    "email" => Auth::user()->email,
                ]
            ]);

            $response = $response->json();

            if (isset($response["pidx"])) {
                DB::commit();
                // Store pidx in session for callback verification
                session(['khalti_pidx' => $response["pidx"]]);
                return redirect()->to($response["payment_url"]);
            } else {
                throw new \Exception($response["error"] ?? 'Khalti payment initialization failed.');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Something went wrong: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Khalti Payment Callback
     */
    public function khalti_callback(Request $request)
    {
        try {
            $pidx = $request->pidx;
            $status = $request->status;
            $orderId = $request->purchase_order_id;

            if (!$orderId) {
                return redirect()->route('orders.index')->with('error', 'Invalid order reference.');
            }

            // Find the order
            $order = Order::where('id', $orderId)
                ->where('user_id', Auth::id())
                ->first();

            if (!$order) {
                return redirect()->route('orders.index')->with('error', 'Order not found.');
            }

            // Verify payment status with Khalti
            $url = env('KHALTI_BASEURL') . "epayment/lookup/";
            $response = Http::withHeaders([
                "Authorization" => "Key " . env('KHALTI_SECRET')
            ])->post($url, [
                "pidx" => $pidx
            ]);

            $responseData = $response->json();

            // Check if payment was successful
            if ($response->successful() && isset($responseData['status']) && $responseData['status'] === 'Completed') {
                // Update order payment status
                $order->update([
                    'payment_status' => true,
                ]);

                return redirect()->route('order.success', $order->id)
                    ->with('success', 'Payment successful! Your order has been placed.');
            } else {
                // Payment failed or was cancelled
                $order->update([
                    'status' => 'cancelled'
                ]);

                return redirect()->route('order.cancel', $order->id)
                    ->with('error', 'Payment was not completed. Please try again.');
            }
        } catch (\Exception $e) {
            return redirect()->route('orders.index')
                ->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    /**
     * Show order success page
     */
    public function success($orderId)
    {
        $order = Order::with(['dokan', 'order_items.product'])
            ->where('user_id', Auth::id())
            ->findOrFail($orderId);

        return view('frontend.order-success', compact('order'));
    }

    /**
     * Show order cancel page
     */
    public function cancel($orderId)
    {
        $order = Order::with(['dokan', 'order_items.product'])
            ->where('user_id', Auth::id())
            ->findOrFail($orderId);

        return view('frontend.order-cancel', compact('order'));
    }

    /**
     * Show order details
     */
    public function show($orderId)
    {
        $order = Order::with(['dokan', 'order_items.product'])
            ->where('user_id', Auth::id())
            ->findOrFail($orderId);

        return view('frontend.order-details', compact('order'));
    }

    /**
     * List user orders
     */
    public function index()
    {
        $orders = Order::with(['dokan', 'order_items.product'])
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('frontend.orders', compact('orders'));
    }
}

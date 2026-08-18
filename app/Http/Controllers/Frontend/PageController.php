<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class PageController extends BaseController
{
    public function home()
    {
        $products = Product::latest()->limit(4)->get();
        return view('frontend.home', compact('products'));
    }

    public function terms()
    {
        return view('frontend.terms');
    }

    public function policy()
    {
        return view('frontend.policy');
    }

    public function products(Request $request)
    {
        $q = $request->q;
        if ($q) {
            $products = Product::where('name', 'like', "%$q%")->latest()->paginate(12);
            return view('frontend.products', compact('products', 'q'));
        }
        $products = Product::latest()->paginate(12);
        return view('frontend.products', compact('products', 'q'));
    }

    public function product_details($slug)
    {
        $product = Product::with('dokan')->where('slug', $slug)->firstOrFail();
        $related_products = Product::where('id', '!=', $product->id)
            ->where('dokan_id', $product->dokan_id)
            ->limit(4)
            ->get();
        return view('frontend.product-details', compact('product', 'related_products'));
    }
}

<?php

namespace App\Http\Controllers\Front;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index()
    {
        $products = \App\Models\Product::with('category')->active()
            ->latest()
            ->limit(8)
            ->get();
        return view('front.product', compact('products'));
    }

    public function show(Product $product)
    {
        if ($product->status != 'active') {
            abort(404);
        }
        return view('front.products.show', compact('product'));
    }
}

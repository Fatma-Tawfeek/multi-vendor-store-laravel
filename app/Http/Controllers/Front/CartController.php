<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Repositories\Cart\CartRepository;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CartRepository $cart)
    {
        return view('front.cart', compact('cart'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, CartRepository $cart)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);
        $product = \App\Models\Product::findOrFail($request->product_id);
        $cart->add($product, $request->quantity);

        return redirect()->route('cart.index')->with('success', 'Product added to cart.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CartRepository $cart)
    {
        $request->validate([
            'product' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);
        $product = \App\Models\Product::findOrFail($request->product_id);
        $cart->update($product, $request->quantity);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CartRepository $cart, string $id)
    {
        $cart->delete($id);
    }
}

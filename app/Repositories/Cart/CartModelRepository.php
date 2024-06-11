<?php

namespace App\Repositories\Cart;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use App\Repositories\Cart\CartRepository;

class CartModelRepository implements CartRepository
{
    protected $items;

    public function __construct()
    {
        $this->items = collect([]);
    }
    public function get(): Collection
    {
        if ($this->items->isEmpty()) {
            $this->items = Cart::with('product')->get();
        }
        return $this->items;
    }

    public function add(Product $product, int $quantity = 1): void
    {
        $item = Cart::where('product_id', $product->id)->first();
        if (!$item) {
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'quantity' => $quantity,
            ]);
        }

        $item->increment('quantity', $quantity);
    }

    public function update($id, int $quantity): void
    {
        Cart::where('id', $id)
            ->update([
                'quantity' => $quantity,
            ]);
    }

    public function delete($id): void
    {
        Cart::where('id', $id)
            ->delete();
    }

    public function empty(): void
    {
        Cart::query()->delete();
    }

    public function total(): float
    {
        // return Cart::sum('quantity');

        // return (float) Cart::join('products', 'products.id', '=', 'carts.product_id')
        //     ->selectRaw('SUM(products.price * carts.quantity) as total')
        //     ->value('total');

        return $this->get()->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });
    }
}

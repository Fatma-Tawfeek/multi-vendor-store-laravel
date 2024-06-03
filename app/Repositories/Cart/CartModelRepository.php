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
    public function get(): Collection
    {
        return Cart::with('product')->where('cookie_id', $this->getCookieId())->get();
    }

    public function add(Product $product, int $quantity = 1): void
    {
        $item = Cart::where('product_id', $product->id)->where('cookie_id', $this->getCookieId())->first();
        if (!$item) {
            Cart::create([
                'cookie_id' => $this->getCookieId(),
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'quantity' => $quantity,
            ]);
        }

        $item->increment('quantity', $quantity);
    }

    public function update(Product $product, int $quantity): void
    {
        Cart::where('product_id', $product->id)
            ->where('cookie_id', $this->getCookieId())
            ->update([
                'quantity' => $quantity,
            ]);
    }

    public function delete($id): void
    {
        Cart::where('id', $id)
            ->where('cookie_id', $this->getCookieId())
            ->delete();
    }

    public function empty(): void
    {
        Cart::where('cookie_id', $this->getCookieId())->destroy();
    }

    public function total(): float
    {
        // return Cart::sum('quantity');

        return (float) Cart::where('cookie_id', $this->getCookieId())
            ->join('products', 'products.id', '=', 'carts.product_id')
            ->selectRaw('SUM(products.price * carts.quantity) as total')
            ->value('total');
    }

    protected function getCookieId()
    {
        $cookie_id = Cookie::get('cart_id');
        if (!$cookie_id) {
            $cookie_id = Str::uuid();
            Cookie::queue('cart_id', $cookie_id, 30 * 24 * 60);
        }

        return $cookie_id;
    }
}

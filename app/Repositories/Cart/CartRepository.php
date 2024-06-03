<?php

namespace App\Repositories\Cart;

use App\Models\Product;
use Illuminate\Support\Collection;

interface CartRepository
{
    public function get(): Collection;

    public function add(Product $product, int $quantity = 1): void;

    public function update(Product $product, int $quantity): void;

    public function delete($id): void;

    public function empty(): void;

    public function total(): float;
}

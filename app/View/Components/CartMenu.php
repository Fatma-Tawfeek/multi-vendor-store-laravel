<?php

namespace App\View\Components;

use Closure;
use App\Facades\Cart;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class CartMenu extends Component
{
    public $items;
    public $total;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->items = Cart::get();

        $this->total = Cart::total();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.cart-menu');
    }
}

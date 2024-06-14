<?php

namespace App\Listeners;

use App\Facades\Cart;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class DeductProductQuantity
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle($order, $user = null): void
    {
        foreach ($order->products as $product) {
            // $product->update([
            //     'quantity' => $product->quantity - $product->pivot->quantity
            // ]);

            $product->decrement('quantity', $product->pivot->quantity);
        }
    }
}

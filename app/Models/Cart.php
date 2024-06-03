<?php

namespace App\Models;

use App\Observers\CartObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory;

    public $incrementing = false;

    protected $fillable = ['cookie_id', 'user_id', 'product_id', 'quantity', 'options'];

    protected static function booted()
    {
        static::observe(CartObserver::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault(['name' => 'Guest']);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{
    use HasFactory;

    protected static function booted()
    {
        static::addGlobalScope('store', function (Builder $builder) {
            $user = Auth::user();
            if ($user->store_id) {
                $builder->where('store_id', $user->store_id);
            }
        });
    }
}

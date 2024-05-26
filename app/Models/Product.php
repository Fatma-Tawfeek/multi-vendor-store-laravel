<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'store_id',
        'category_id',
        'name',
        'description',
        'price',
        'slug',
        'compare_price',
        'image',
        'status',
        'featured',
    ];

    protected static function booted()
    {
        static::addGlobalScope('store', function (Builder $builder) {
            $user = Auth::user();
            if ($user && $user->store_id) {
                $builder->where('store_id', $user->store_id);
            }
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'product_tag', 'product_id', 'tag_id', 'id', 'id');
    }

    public function scopeActive(Builder $query)
    {
        return $query->where('status', 'active');
    }

    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            return 'https://sudbury.legendboats.com/resource/defaultProductImage';
        } elseif (Str::startsWith($this->image, ['https://', 'http://'])) {
            return $this->image;
        } else {
            return asset('storage/' . $this->image);
        }
    }

    public function getSalePercentAttribute()
    {
        if ($this->compare_price) {
            return round(($this->price / $this->compare_price) * 100);
        } else {
            return 0;
        }
    }
}

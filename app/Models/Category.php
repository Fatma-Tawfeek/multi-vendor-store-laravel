<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'parent_id',
        'description',
        'image',
        'status'
    ];

    public static function rules($id = 0)
    {
        return [
            'name' => [
                'required',
                'string',
                'min:3',
                'max:255',
                'filter:php,laravel',
                'unique:categories,name',
                // function ($attribute, $value, $fail) {
                //     if (strtolower($value) === 'laravel') {
                //         $fail('This name is not allowed');
                //     }
                // }
            ],
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'parent_id' => 'nullable|integer|exists:categories,id',
            'status' => 'required|in:active,archived',
        ];
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function scopeActive(Builder $builder)
    {
        return $builder->where('status', 'active');
    }

    public function scopeStatus(Builder $builder, $status)
    {
        return $builder->where('status', $status);
    }

    public function scopeFilter(Builder $builder, $filters)
    {
        // if ($filters['name'] ?? false) {
        //     $builder->where('name', 'like', '%' . $filters['name'] . '%');
        // }
        // if ($filters['status'] ?? false) {
        //     $builder->where('status', $filters['status']);
        // }

        $builder->when($filters['name'] ?? false, function ($builder, $name) {
            $builder->where('name', 'like', '%' . $name . '%');
        });

        $builder->when($filters['status'] ?? false, function ($builder, $status) {
            $builder->where('status', $status);
        });
    }
}

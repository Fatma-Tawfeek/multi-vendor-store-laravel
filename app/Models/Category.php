<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

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
                // 'unique:categories,name',
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
}

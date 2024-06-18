<?php

namespace App\Models;

use Symfony\Component\Intl\Countries;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderAddress extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'order_id',
        'first_name',
        'last_name',
        'email',
        'type',
        'street_address',
        'city',
        'state',
        'postal_code',
        'country',
        'phone_number'
    ];

    public function getNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getCountryNameAttribute()
    {
        return Countries::getName($this->country);
    }
}

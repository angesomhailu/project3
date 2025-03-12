<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand',
        'model',
        'year',
        'color',
        'price_per_day',
        'description',
        'image',
        'status', // available, rented, maintenance
        'transmission',
        'fuel_type',
        'seats',
        'luggage',
    ];

    protected $casts = [
        'price_per_day' => 'decimal:2',
        'year' => 'integer',
        'seats' => 'integer',
        'luggage' => 'integer',
    ];

    public function rentals()
    {
        return $this->hasMany(Rental::class);
    }
}

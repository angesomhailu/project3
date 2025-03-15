<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'make',
        'model',
        'year',
        'color',
        'license_plate',
        'daily_rate',
        'description',
        'mileage',
        'transmission',
        'fuel_type',
        'seats',
        'images',
        'features',
        'status',
    ];

    protected $casts = [
        'images' => 'array',
        'features' => 'array',
        'daily_rate' => 'decimal:2',
        'mileage' => 'decimal:1',
    ];

    public function isAvailable()
    {
        return $this->status === 'available';
    }

    public function rentals()
    {
        return $this->hasMany(Rental::class);
    }

    public function scopeAvailable($query)
    {
        return $query->where('status', 'available');
    }

    public function scopeMaintenance($query)
    {
        return $query->where('status', 'maintenance');
    }

    public function scopeRented($query)
    {
        return $query->where('status', 'rented');
    }
}
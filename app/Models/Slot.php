<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slot extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'start_time',
        'end_time',
        'is_available',
        'price',
    ];

    protected $casts = [
        'date' => 'date',
        'is_available' => 'boolean',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function isBooked()
    {
        return $this->bookings()->exists();
    }
} 
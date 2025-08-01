<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'slot_id',
        'customer_name',
        'customer_email',
        'booking_date'
    ];

    protected $casts = [
        'booking_date' => 'date',
    ];

    public function slot()
    {
        return $this->belongsTo(Slot::class);
    }
} 
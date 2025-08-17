<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BidanAvailability extends Model
{
    use HasFactory;

    protected $fillable = [
        'bidan_id', 'available_date', 'start_time', 'end_time',
        'is_available', 'status', 'max_bookings', 'current_bookings'
    ];

    protected $casts = [
        'available_date' => 'date',
        'start_time' => 'datetime:H:i',
        'end_time' => 'datetime:H:i',
        'is_available' => 'boolean',
        'max_bookings' => 'integer',
        'current_bookings' => 'integer'
    ];

    public function bidan(): BelongsTo
    {
        return $this->belongsTo(BidanProfile::class, 'bidan_id');
    }

    public function scopeAvailable($query)
    {
        return $query->where('is_available', true)
                     ->where('status', 'available');
    }

    public function isAvailable(): bool
    {
        return $this->is_available && $this->status === 'available';
    }

    public function hasCapacity(): bool
    {
        return $this->current_bookings < $this->max_bookings;
    }
}

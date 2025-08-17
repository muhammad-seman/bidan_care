<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BidanService extends Model
{
    use HasFactory;

    protected $fillable = [
        'bidan_id',
        'service_name',
        'description',
        'price',
        'duration_minutes',
        'service_type',
        'category',
        'requirements',
        'included_services',
        'preparation_notes',
        'min_booking_hours',
        'max_advance_days',
        'allow_reschedule',
        'allow_cancellation',
        'cancellation_hours',
        'is_active',
        'total_bookings',
        'average_rating'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'duration_minutes' => 'integer',
        'requirements' => 'array',
        'included_services' => 'array',
        'min_booking_hours' => 'integer',
        'max_advance_days' => 'integer',
        'allow_reschedule' => 'boolean',
        'allow_cancellation' => 'boolean',
        'cancellation_hours' => 'integer',
        'is_active' => 'boolean',
        'total_bookings' => 'integer',
        'average_rating' => 'decimal:2'
    ];

    // Relationships
    public function bidan(): BelongsTo
    {
        return $this->belongsTo(BidanProfile::class, 'bidan_id');
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class, 'service_id');
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeByCategory($query, string $category)
    {
        return $query->where('category', $category);
    }

    public function scopeByServiceType($query, string $type)
    {
        return $query->where('service_type', $type);
    }

    public function scopeInPriceRange($query, $minPrice, $maxPrice)
    {
        return $query->whereBetween('price', [$minPrice, $maxPrice]);
    }

    // Helper Methods
    public function isActive(): bool
    {
        return $this->is_active;
    }

    public function getPriceWithPlatformFeeAttribute(): float
    {
        return $this->price * 1.10; // 10% platform fee
    }

    public function getPlatformFeeAttribute(): float
    {
        return $this->price * 0.10;
    }

    public function getDurationInHoursAttribute(): float
    {
        return $this->duration_minutes / 60;
    }
}

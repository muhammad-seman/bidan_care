<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_number',
        'patient_id',
        'bidan_id', 
        'service_id',
        'availability_id',
        'booking_date',
        'start_time',
        'end_time',
        'duration_minutes',
        'service_type',
        'service_location',
        'patient_province_id',
        'patient_regency_id',
        'patient_district_id',
        'patient_village_id',
        'patient_address',
        'patient_address_notes',
        'service_price',
        'platform_fee',
        'total_amount',
        'bidan_amount',
        'status',
        'payment_status',
        'confirmed_at',
        'service_started_at',
        'service_completed_at',
        'cancelled_at',
        'payment_due_at',
        'cancellation_reason',
        'cancelled_by',
        'rescheduled_from_booking_id',
        'is_rescheduled',
        'patient_notes',
        'bidan_notes',
        'admin_notes',
        'special_requirements',
        'patient_reviewed',
        'bidan_reviewed'
    ];

    protected $casts = [
        'booking_date' => 'date',
        'start_time' => 'datetime:H:i',
        'end_time' => 'datetime:H:i',
        'duration_minutes' => 'integer',
        'service_price' => 'decimal:2',
        'platform_fee' => 'decimal:2',
        'total_amount' => 'decimal:2',
        'bidan_amount' => 'decimal:2',
        'confirmed_at' => 'datetime',
        'service_started_at' => 'datetime',
        'service_completed_at' => 'datetime',
        'cancelled_at' => 'datetime',
        'payment_due_at' => 'datetime',
        'is_rescheduled' => 'boolean',
        'special_requirements' => 'array',
        'patient_reviewed' => 'boolean',
        'bidan_reviewed' => 'boolean'
    ];

    // Relationships
    public function patient(): BelongsTo
    {
        return $this->belongsTo(User::class, 'patient_id');
    }

    public function bidan(): BelongsTo
    {
        return $this->belongsTo(BidanProfile::class, 'bidan_id');
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(BidanService::class, 'service_id');
    }

    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class);
    }

    public function review(): HasOne
    {
        return $this->hasOne(Review::class);
    }

    // Scopes & Helper Methods
    public function scopeUpcoming($query)
    {
        return $query->where('booking_date', '>=', now()->toDateString())
                     ->whereIn('status', ['confirmed', 'in_progress']);
    }

    public function isCompleted(): bool
    {
        return $this->status === 'completed';
    }

    public function canBeCancelled(): bool
    {
        return in_array($this->status, ['pending_payment', 'confirmed']);
    }

    public static function generateBookingNumber(): string
    {
        return 'BK-' . date('Y') . '-' . str_pad(mt_rand(1, 999999), 6, '0', STR_PAD_LEFT);
    }
}

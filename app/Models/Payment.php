<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment_number', 'booking_id', 'amount', 'service_amount', 'platform_fee',
        'payment_method', 'payment_gateway', 'gateway_reference', 'status',
        'paid_at', 'released_at', 'gateway_response'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'service_amount' => 'decimal:2', 
        'platform_fee' => 'decimal:2',
        'paid_at' => 'datetime',
        'released_at' => 'datetime',
        'gateway_response' => 'array'
    ];

    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class);
    }

    public function isPaid(): bool
    {
        return $this->status === 'paid';
    }

    public static function generatePaymentNumber(): string
    {
        return 'PAY-' . date('Y') . '-' . str_pad(mt_rand(1, 999999), 6, '0', STR_PAD_LEFT);
    }
}

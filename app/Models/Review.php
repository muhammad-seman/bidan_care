<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id', 'patient_id', 'bidan_id', 'rating', 'review_text',
        'is_anonymous', 'communication_rating', 'professionalism_rating',
        'punctuality_rating', 'service_quality_rating', 'is_published',
        'bidan_response', 'bidan_responded_at'
    ];

    protected $casts = [
        'rating' => 'integer',
        'is_anonymous' => 'boolean',
        'is_published' => 'boolean',
        'communication_rating' => 'integer',
        'professionalism_rating' => 'integer',
        'punctuality_rating' => 'integer',
        'service_quality_rating' => 'integer',
        'bidan_responded_at' => 'datetime'
    ];

    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class);
    }

    public function patient(): BelongsTo
    {
        return $this->belongsTo(User::class, 'patient_id');
    }

    public function bidan(): BelongsTo
    {
        return $this->belongsTo(BidanProfile::class, 'bidan_id');
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function getOverallRatingAttribute(): float
    {
        $ratings = array_filter([
            $this->communication_rating,
            $this->professionalism_rating,
            $this->punctuality_rating,
            $this->service_quality_rating
        ]);
        
        return count($ratings) > 0 ? array_sum($ratings) / count($ratings) : $this->rating;
    }
}

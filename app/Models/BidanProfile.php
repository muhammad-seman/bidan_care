<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BidanProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'license_number',
        'license_file_path',
        'verification_status',
        'verified_at',
        'verified_by',
        'province_id',
        'regency_id', 
        'district_id',
        'village_id',
        'detailed_address',
        'google_maps_link',
        'bio',
        'experience_years',
        'certification_files',
        'phone',
        'birth_date',
        'practice_type',
        'specializations',
        'emergency_available',
        'is_active',
        'rating_average',
        'total_reviews',
        'total_patients'
    ];

    protected $casts = [
        'verified_at' => 'datetime',
        'birth_date' => 'date',
        'certification_files' => 'array',
        'emergency_available' => 'boolean',
        'is_active' => 'boolean',
        'rating_average' => 'decimal:2',
        'total_reviews' => 'integer',
        'total_patients' => 'integer',
        'experience_years' => 'integer'
    ];

    // Relationships
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function verifiedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'verified_by');
    }

    public function services(): HasMany
    {
        return $this->hasMany(BidanService::class, 'bidan_id');
    }

    public function availability(): HasMany
    {
        return $this->hasMany(BidanAvailability::class, 'bidan_id');
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class, 'bidan_id');
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class, 'bidan_id');
    }

    public function galleries(): HasMany
    {
        return $this->hasMany(BidanGallery::class, 'bidan_id');
    }

    // Scopes
    public function scopeVerified($query)
    {
        return $query->where('verification_status', 'approved');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeAvailable($query)
    {
        return $query->verified()->active();
    }

    // Helper Methods
    public function isVerified(): bool
    {
        return $this->verification_status === 'approved';
    }

    public function isActive(): bool
    {
        return $this->is_active;
    }

    public function getFullAddressAttribute(): string
    {
        return $this->detailed_address; // Will be enhanced with wilayah API
    }

    public function getActiveServicesAttribute()
    {
        return $this->services()->where('is_active', true)->get();
    }
}

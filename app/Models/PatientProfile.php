<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PatientProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'birth_date',
        'gender',
        'phone',
        'id_number',
        'province_id',
        'regency_id',
        'district_id',
        'village_id',
        'address',
        'emergency_contact_name',
        'emergency_contact_phone',
        'emergency_contact_relation',
        'medical_history',
        'allergies',
        'current_medications',
        'blood_type',
        'insurance_provider',
        'insurance_number',
        'home_visit_preference',
        'preferred_bidan_ids',
        'special_notes'
    ];

    protected $casts = [
        'birth_date' => 'date',
        'home_visit_preference' => 'boolean',
        'preferred_bidan_ids' => 'array',
        'medical_history' => 'encrypted',
        'allergies' => 'encrypted',
        'current_medications' => 'encrypted'
    ];

    // Relationships
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class, 'patient_id');
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class, 'patient_id');
    }

    // Helper Methods
    public function getAgeAttribute(): ?int
    {
        return $this->birth_date ? $this->birth_date->age : null;
    }

    public function getFullAddressAttribute(): string
    {
        return $this->address; // Will be enhanced with wilayah API
    }

    public function hasPreferredBidan(int $bidanId): bool
    {
        return in_array($bidanId, $this->preferred_bidan_ids ?? []);
    }

    public function addPreferredBidan(int $bidanId): void
    {
        $preferred = $this->preferred_bidan_ids ?? [];
        if (!in_array($bidanId, $preferred)) {
            $preferred[] = $bidanId;
            $this->update(['preferred_bidan_ids' => $preferred]);
        }
    }

    public function removePreferredBidan(int $bidanId): void
    {
        $preferred = $this->preferred_bidan_ids ?? [];
        $filtered = array_filter($preferred, fn($id) => $id !== $bidanId);
        $this->update(['preferred_bidan_ids' => array_values($filtered)]);
    }
}

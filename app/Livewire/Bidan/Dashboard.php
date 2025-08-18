<?php

namespace App\Livewire\Bidan;

use Livewire\Component;
use App\Models\BidanService;
use App\Models\Booking;
use App\Models\Review;
use Carbon\Carbon;

class Dashboard extends Component
{
    public function getTodayBookingsProperty()
    {
        $bidanProfile = auth()->user()->bidanProfile;
        if (!$bidanProfile) return 0;
        
        // Use direct service lookup since bookings table may not exist yet
        $serviceIds = BidanService::where('bidan_id', $bidanProfile->id)->pluck('id');
        
        try {
            return Booking::whereIn('bidan_service_id', $serviceIds)
                         ->whereDate('booking_date', Carbon::today())
                         ->count();
        } catch (\Exception $e) {
            // Return 0 if bookings table doesn't exist yet
            return 0;
        }
    }

    public function getTotalPatientsProperty()
    {
        $bidanProfile = auth()->user()->bidanProfile;
        if (!$bidanProfile) return 0;
        
        $serviceIds = BidanService::where('bidan_id', $bidanProfile->id)->pluck('id');
        
        try {
            return Booking::whereIn('bidan_service_id', $serviceIds)
                         ->where('status', 'completed')
                         ->distinct('patient_id')
                         ->count('patient_id');
        } catch (\Exception $e) {
            return 0;
        }
    }

    public function getActiveServicesProperty()
    {
        $bidanProfile = auth()->user()->bidanProfile;
        if (!$bidanProfile) return 0;
        
        return BidanService::where('bidan_id', $bidanProfile->id)
                          ->where('is_active', true)
                          ->count();
    }

    public function getMonthlyEarningsProperty()
    {
        $bidanProfile = auth()->user()->bidanProfile;
        if (!$bidanProfile) return 0;
        
        $serviceIds = BidanService::where('bidan_id', $bidanProfile->id)->pluck('id');
        
        try {
            $earnings = Booking::whereIn('bidan_service_id', $serviceIds)
                              ->where('status', 'completed')
                              ->whereMonth('created_at', Carbon::now()->month)
                              ->whereYear('created_at', Carbon::now()->year)
                              ->join('bidan_services', 'bookings.bidan_service_id', '=', 'bidan_services.id')
                              ->sum('bidan_services.price');
            
            // Platform mengambil 10%, bidan dapat 90%
            return $earnings * 0.9;
        } catch (\Exception $e) {
            return 0;
        }
    }

    public function getVerificationStatusProperty()
    {
        $bidanProfile = auth()->user()->bidanProfile;
        return $bidanProfile ? $bidanProfile->verification_status : 'pending';
    }

    public function getRecentReviewsProperty()
    {
        $bidanProfile = auth()->user()->bidanProfile;
        if (!$bidanProfile) return collect();
        
        try {
            $serviceIds = BidanService::where('bidan_id', $bidanProfile->id)->pluck('id');
            
            return Review::whereHas('booking', function($query) use ($serviceIds) {
                $query->whereIn('bidan_service_id', $serviceIds);
            })->with(['booking.patient'])
              ->latest()
              ->limit(3)
              ->get();
        } catch (\Exception $e) {
            return collect();
        }
    }

    public function render()
    {
        return view('livewire.bidan.dashboard');
    }
}
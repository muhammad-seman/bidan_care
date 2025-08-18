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
        
        return Booking::whereHas('bidanService', function($query) use ($bidanProfile) {
            $query->where('bidan_id', $bidanProfile->id);
        })->whereDate('scheduled_at', Carbon::today())->count();
    }

    public function getTotalPatientsProperty()
    {
        $bidanProfile = auth()->user()->bidanProfile;
        if (!$bidanProfile) return 0;
        
        return Booking::whereHas('bidanService', function($query) use ($bidanProfile) {
            $query->where('bidan_id', $bidanProfile->id);
        })->where('status', 'completed')->distinct('patient_id')->count('patient_id');
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
        
        $earnings = Booking::whereHas('bidanService', function($query) use ($bidanProfile) {
            $query->where('bidan_id', $bidanProfile->id);
        })->where('status', 'completed')
          ->whereMonth('created_at', Carbon::now()->month)
          ->whereYear('created_at', Carbon::now()->year)
          ->join('bidan_services', 'bookings.bidan_service_id', '=', 'bidan_services.id')
          ->sum('bidan_services.price');
        
        // Platform mengambil 10%, bidan dapat 90%
        return $earnings * 0.9;
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
        
        return Review::whereHas('booking.bidanService', function($query) use ($bidanProfile) {
            $query->where('bidan_id', $bidanProfile->id);
        })->with(['booking.patient'])
          ->latest()
          ->limit(3)
          ->get();
    }

    public function render()
    {
        return view('livewire.bidan.dashboard');
    }
}
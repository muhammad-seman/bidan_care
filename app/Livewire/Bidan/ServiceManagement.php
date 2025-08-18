<?php

namespace App\Livewire\Bidan;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\BidanService;
use App\Models\BidanProfile;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;

class ServiceManagement extends Component
{
    use WithPagination;

    // Form properties
    public $showModal = false;
    public $editingService = null;
    public $isEditing = false;

    // Service form fields
    #[Validate('required|string|max:255')]
    public $service_name = '';
    
    #[Validate('required|string|min:20')]
    public $description = '';
    
    #[Validate('required|numeric|min:10000|max:5000000')]
    public $price = '';
    
    #[Validate('required|integer|min:15|max:480')]
    public $duration_minutes = 60;
    
    #[Validate('required|in:home_visit,clinic')]
    public $service_type = 'clinic';
    
    #[Validate('required|in:konsultasi_kehamilan,perawatan_pasca_melahirkan,pemeriksaan_rutin,konsultasi_umum,emergency_care,prenatal_care,postnatal_care,lainnya')]
    public $category = 'konsultasi_umum';
    
    public $requirements = '';
    public $included_services = '';
    public $preparation_notes = '';
    public $min_booking_hours = 2;
    public $max_advance_days = 30;
    public $allow_reschedule = true;
    public $allow_cancellation = true;
    public $cancellation_hours = 24;

    // Filter properties
    public $statusFilter = 'all';
    public $categoryFilter = 'all';
    public $search = '';

    protected $bidanProfile;

    public function mount()
    {
        $this->bidanProfile = auth()->user()->bidanProfile;
        
        if (!$this->bidanProfile || !$this->bidanProfile->isVerified()) {
            abort(403, 'Akses ditolak. Profil bidan belum terverifikasi.');
        }
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingStatusFilter()
    {
        $this->resetPage();
    }

    public function updatingCategoryFilter()
    {
        $this->resetPage();
    }

    public function openCreateModal()
    {
        $this->resetForm();
        $this->showModal = true;
        $this->isEditing = false;
    }

    public function openEditModal($serviceId)
    {
        $service = BidanService::where('bidan_id', $this->bidanProfile->id)
                               ->findOrFail($serviceId);
        
        $this->editingService = $service;
        $this->isEditing = true;
        $this->showModal = true;
        
        // Populate form with service data
        $this->service_name = $service->service_name;
        $this->description = $service->description;
        $this->price = $service->price;
        $this->duration_minutes = $service->duration_minutes;
        $this->service_type = $service->service_type;
        $this->category = $service->category;
        $this->requirements = $service->requirements ? implode("\n", json_decode($service->requirements, true) ?? []) : '';
        $this->included_services = $service->included_services ? implode("\n", json_decode($service->included_services, true) ?? []) : '';
        $this->preparation_notes = $service->preparation_notes;
        $this->min_booking_hours = $service->min_booking_hours;
        $this->max_advance_days = $service->max_advance_days;
        $this->allow_reschedule = $service->allow_reschedule;
        $this->allow_cancellation = $service->allow_cancellation;
        $this->cancellation_hours = $service->cancellation_hours;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->editingService = null;
        $this->isEditing = false;
        $this->resetForm();
        $this->resetValidation();
    }

    public function resetForm()
    {
        $this->service_name = '';
        $this->description = '';
        $this->price = '';
        $this->duration_minutes = 60;
        $this->service_type = 'clinic';
        $this->category = 'konsultasi_umum';
        $this->requirements = '';
        $this->included_services = '';
        $this->preparation_notes = '';
        $this->min_booking_hours = 2;
        $this->max_advance_days = 30;
        $this->allow_reschedule = true;
        $this->allow_cancellation = true;
        $this->cancellation_hours = 24;
    }

    public function saveService()
    {
        $this->validate();

        $data = [
            'bidan_id' => $this->bidanProfile->id,
            'service_name' => $this->service_name,
            'description' => $this->description,
            'price' => $this->price,
            'duration_minutes' => $this->duration_minutes,
            'service_type' => $this->service_type,
            'category' => $this->category,
            'requirements' => $this->requirements ? json_encode(array_filter(explode("\n", $this->requirements))) : null,
            'included_services' => $this->included_services ? json_encode(array_filter(explode("\n", $this->included_services))) : null,
            'preparation_notes' => $this->preparation_notes ?: null,
            'min_booking_hours' => $this->min_booking_hours,
            'max_advance_days' => $this->max_advance_days,
            'allow_reschedule' => $this->allow_reschedule,
            'allow_cancellation' => $this->allow_cancellation,
            'cancellation_hours' => $this->cancellation_hours,
            'is_active' => true,
        ];

        if ($this->isEditing) {
            $this->editingService->update($data);
            session()->flash('success', 'Service berhasil diperbarui!');
        } else {
            BidanService::create($data);
            session()->flash('success', 'Service baru berhasil ditambahkan!');
        }

        $this->closeModal();
    }

    public function toggleServiceStatus($serviceId)
    {
        $service = BidanService::where('bidan_id', $this->bidanProfile->id)
                               ->findOrFail($serviceId);
        
        $service->update(['is_active' => !$service->is_active]);
        
        $status = $service->is_active ? 'diaktifkan' : 'dinonaktifkan';
        session()->flash('success', "Service berhasil {$status}!");
    }

    public function deleteService($serviceId)
    {
        $service = BidanService::where('bidan_id', $this->bidanProfile->id)
                               ->findOrFail($serviceId);
        
        // Check if service has active bookings
        if ($service->total_bookings > 0) {
            session()->flash('error', 'Tidak dapat menghapus service yang sudah memiliki booking. Nonaktifkan service tersebut sebagai gantinya.');
            return;
        }
        
        $service->delete();
        session()->flash('success', 'Service berhasil dihapus!');
    }

    public function getCategoriesProperty()
    {
        return [
            'konsultasi_kehamilan' => 'Konsultasi Kehamilan',
            'perawatan_pasca_melahirkan' => 'Perawatan Pasca Melahirkan',
            'pemeriksaan_rutin' => 'Pemeriksaan Rutin',
            'konsultasi_umum' => 'Konsultasi Umum',
            'emergency_care' => 'Perawatan Darurat',
            'prenatal_care' => 'Perawatan Prenatal',
            'postnatal_care' => 'Perawatan Postnatal',
            'lainnya' => 'Lainnya',
        ];
    }

    public function getServiceTypesProperty()
    {
        return [
            'home_visit' => 'Kunjungan Rumah',
            'clinic' => 'Di Klinik',
        ];
    }

    public function render()
    {
        $query = BidanService::where('bidan_id', $this->bidanProfile->id)
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('service_name', 'like', '%' . $this->search . '%')
                      ->orWhere('description', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->statusFilter !== 'all', function ($query) {
                $query->where('is_active', $this->statusFilter === 'active');
            })
            ->when($this->categoryFilter !== 'all', function ($query) {
                $query->where('category', $this->categoryFilter);
            })
            ->orderBy('created_at', 'desc');

        $services = $query->paginate(10);

        // Statistics
        $stats = [
            'total' => BidanService::where('bidan_id', $this->bidanProfile->id)->count(),
            'active' => BidanService::where('bidan_id', $this->bidanProfile->id)->where('is_active', true)->count(),
            'inactive' => BidanService::where('bidan_id', $this->bidanProfile->id)->where('is_active', false)->count(),
            'total_bookings' => BidanService::where('bidan_id', $this->bidanProfile->id)->sum('total_bookings'),
        ];

        return view('livewire.bidan.service-management', compact('services', 'stats'))
            ->layout('components.layouts.app', ['title' => 'Kelola Layanan']);
    }
}
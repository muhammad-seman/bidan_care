<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\BidanProfile;
use App\Models\User;
use App\Services\WilayahService;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Storage;

class BidanVerification extends Component
{
    use WithPagination;

    public $search = '';
    public $statusFilter = 'all';
    public $showModal = false;
    public $selectedBidan = null;
    public $verificationNotes = '';
    public $verificationAction = '';
    
    protected $wilayahService;
    
    public function boot(WilayahService $wilayahService)
    {
        $this->wilayahService = $wilayahService;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingStatusFilter()
    {
        $this->resetPage();
    }

    public function viewBidanDetails($bidanId)
    {
        $this->selectedBidan = BidanProfile::with('user')->findOrFail($bidanId);
        $this->showModal = true;
        $this->verificationNotes = '';
        $this->verificationAction = '';
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->selectedBidan = null;
        $this->verificationNotes = '';
        $this->verificationAction = '';
    }

    public function verifyBidan($action)
    {
        $this->validate([
            'verificationNotes' => 'required|string|min:10|max:500'
        ]);

        if (!$this->selectedBidan) {
            return;
        }

        $status = $action === 'approve' ? 'verified' : 'rejected';
        $isActive = $action === 'approve';

        $this->selectedBidan->update([
            'verification_status' => $status,
            'verification_notes' => $this->verificationNotes,
            'verified_at' => $action === 'approve' ? now() : null,
            'verified_by' => auth()->id(),
            'is_active' => $isActive
        ]);

        // Send notification to bidan user
        $this->dispatchBidanNotification($this->selectedBidan->user, $status);

        session()->flash('success', 
            $action === 'approve' 
                ? 'Bidan berhasil diverifikasi dan dapat mulai menerima booking.'
                : 'Bidan ditolak. Mereka akan mendapat notifikasi untuk melengkapi persyaratan.'
        );

        $this->closeModal();
    }

    private function dispatchBidanNotification($user, $status)
    {
        // Here you would typically send email/SMS notification
        // For now, we'll just create a flash message
        $message = $status === 'verified' 
            ? "Selamat! Akun bidan Anda telah diverifikasi dan aktif."
            : "Verifikasi akun Anda ditolak. Silakan periksa catatan dan lengkapi persyaratan.";
            
        // In a real app, dispatch notification job here
        // dispatch(new SendBidanVerificationNotification($user, $status, $this->verificationNotes));
    }

    public function downloadDocument($documentType)
    {
        if (!$this->selectedBidan) {
            return;
        }

        $documentUrl = match($documentType) {
            'license' => $this->selectedBidan->license_document_url,
            'certification' => $this->selectedBidan->certification_document_url,
            default => null
        };

        if ($documentUrl && Storage::disk('public')->exists($documentUrl)) {
            return Storage::disk('public')->download($documentUrl);
        }

        session()->flash('error', 'Dokumen tidak ditemukan.');
    }

    public function getFullAddressProperty()
    {
        if (!$this->selectedBidan) {
            return '';
        }

        return $this->wilayahService->getFullAddress(
            $this->selectedBidan->province_id,
            $this->selectedBidan->regency_id,
            $this->selectedBidan->district_id,
            $this->selectedBidan->village_id,
            $this->selectedBidan->detailed_address
        );
    }

    public function render()
    {
        $query = BidanProfile::with(['user'])
            ->when($this->search, function ($query) {
                $query->whereHas('user', function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('email', 'like', '%' . $this->search . '%');
                })->orWhere('license_number', 'like', '%' . $this->search . '%')
                  ->orWhere('specialization', 'like', '%' . $this->search . '%');
            })
            ->when($this->statusFilter !== 'all', function ($query) {
                $query->where('verification_status', $this->statusFilter);
            })
            ->orderBy('created_at', 'desc');

        $bidanProfiles = $query->paginate(10);

        // Statistics
        $stats = [
            'total' => BidanProfile::count(),
            'pending' => BidanProfile::where('verification_status', 'pending')->count(),
            'verified' => BidanProfile::where('verification_status', 'verified')->count(),
            'rejected' => BidanProfile::where('verification_status', 'rejected')->count(),
        ];

        return view('livewire.admin.bidan-verification', compact('bidanProfiles', 'stats'))
            ->layout('components.layouts.app', ['title' => 'Verifikasi Bidan']);
    }
}
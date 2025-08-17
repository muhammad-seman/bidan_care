<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\User;
use App\Models\BidanProfile;
use App\Services\WilayahService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;

class BidanRegistration extends Component
{
    use WithFileUploads;

    // User registration data
    #[Validate('required|string|max:255')]
    public $name = '';
    
    #[Validate('required|email|unique:users,email')]
    public $email = '';
    
    #[Validate('required|string|min:8|confirmed')]
    public $password = '';
    
    public $password_confirmation = '';
    
    #[Validate('required|string|max:20')]
    public $phone = '';

    // Bidan profile data
    #[Validate('required|string|max:50')]
    public $license_number = '';
    
    #[Validate('required|string|max:100')]
    public $specialization = '';
    
    #[Validate('required|integer|min:1|max:50')]
    public $experience_years = '';
    
    #[Validate('required|string')]
    public $bio = '';
    
    #[Validate('required|string')]
    public $detailed_address = '';

    // Wilayah data
    public $selectedProvince = '';
    public $selectedRegency = '';
    public $selectedDistrict = '';
    public $selectedVillage = '';
    
    // Files
    #[Validate('required|file|mimes:pdf,jpg,jpeg,png|max:2048')]
    public $license_document;
    
    #[Validate('required|file|mimes:pdf,jpg,jpeg,png|max:2048')]
    public $certification_document;
    
    #[Validate('nullable|file|mimes:jpg,jpeg,png|max:1024')]
    public $profile_photo;

    // Form state
    public $currentStep = 1;
    public $totalSteps = 4;
    public $isSubmitting = false;
    
    protected $wilayahService;
    
    public function boot(WilayahService $wilayahService)
    {
        $this->wilayahService = $wilayahService;
    }

    public function rules()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'required|string|max:20',
            'license_number' => 'required|string|max:50|unique:bidan_profiles,license_number',
            'specialization' => 'required|string|max:100',
            'experience_years' => 'required|integer|min:1|max:50',
            'bio' => 'required|string|min:50',
            'detailed_address' => 'required|string',
            'selectedProvince' => 'required',
            'selectedRegency' => 'required',
            'selectedDistrict' => 'required',
            'selectedVillage' => 'required',
            'license_document' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'certification_document' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'profile_photo' => 'nullable|file|mimes:jpg,jpeg,png|max:1024'
        ];

        return $rules;
    }

    public function mount()
    {
        $this->currentStep = 1;
    }

    #[On('wilayah-updated')]
    public function handleWilayahUpdate($data)
    {
        $this->selectedProvince = $data['province'] ?? '';
        $this->selectedRegency = $data['regency'] ?? '';
        $this->selectedDistrict = $data['district'] ?? '';
        $this->selectedVillage = $data['village'] ?? '';
    }

    public function nextStep()
    {
        $this->validateCurrentStep();
        
        if ($this->currentStep < $this->totalSteps) {
            $this->currentStep++;
        }
    }

    public function previousStep()
    {
        if ($this->currentStep > 1) {
            $this->currentStep--;
        }
    }

    protected function validateCurrentStep()
    {
        switch ($this->currentStep) {
            case 1:
                $this->validate([
                    'name' => 'required|string|max:255',
                    'email' => 'required|email|unique:users,email',
                    'password' => 'required|string|min:8|confirmed',
                    'phone' => 'required|string|max:20'
                ]);
                break;
                
            case 2:
                $this->validate([
                    'license_number' => 'required|string|max:50|unique:bidan_profiles,license_number',
                    'specialization' => 'required|string|max:100',
                    'experience_years' => 'required|integer|min:1|max:50',
                    'bio' => 'required|string|min:50'
                ]);
                break;
                
            case 3:
                $this->validate([
                    'detailed_address' => 'required|string',
                    'selectedProvince' => 'required',
                    'selectedRegency' => 'required',
                    'selectedDistrict' => 'required',
                    'selectedVillage' => 'required'
                ]);
                break;
                
            case 4:
                $this->validate([
                    'license_document' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
                    'certification_document' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
                    'profile_photo' => 'nullable|file|mimes:jpg,jpeg,png|max:1024'
                ]);
                break;
        }
    }

    public function submit()
    {
        $this->isSubmitting = true;
        
        try {
            $this->validate();
            
            DB::beginTransaction();
            
            // Create user
            $user = User::create([
                'name' => $this->name,
                'email' => $this->email,
                'password' => Hash::make($this->password),
                'phone' => $this->phone,
                'role' => 'bidan'
            ]);
            
            // Upload files
            $licenseDocumentPath = $this->license_document->store('bidan-documents/licenses', 'public');
            $certificationDocumentPath = $this->certification_document->store('bidan-documents/certifications', 'public');
            $profilePhotoPath = $this->profile_photo ? 
                $this->profile_photo->store('bidan-photos/profiles', 'public') : null;
            
            // Create bidan profile
            BidanProfile::create([
                'user_id' => $user->id,
                'license_number' => $this->license_number,
                'specialization' => $this->specialization,
                'experience_years' => $this->experience_years,
                'bio' => $this->bio,
                'detailed_address' => $this->detailed_address,
                'province_id' => $this->selectedProvince,
                'regency_id' => $this->selectedRegency,
                'district_id' => $this->selectedDistrict,
                'village_id' => $this->selectedVillage,
                'license_document_url' => $licenseDocumentPath,
                'certification_document_url' => $certificationDocumentPath,
                'profile_photo_url' => $profilePhotoPath,
                'verification_status' => 'pending',
                'is_active' => false
            ]);
            
            DB::commit();
            
            session()->flash('success', 'Pendaftaran berhasil! Akun Anda sedang dalam proses verifikasi admin. Kami akan mengirimkan notifikasi melalui email setelah verifikasi selesai.');
            
            return redirect()->route('login');
            
        } catch (\Exception $e) {
            DB::rollBack();
            
            // Clean up uploaded files if exists
            if (isset($licenseDocumentPath)) Storage::disk('public')->delete($licenseDocumentPath);
            if (isset($certificationDocumentPath)) Storage::disk('public')->delete($certificationDocumentPath);
            if (isset($profilePhotoPath)) Storage::disk('public')->delete($profilePhotoPath);
            
            session()->flash('error', 'Terjadi kesalahan saat mendaftar. Silakan coba lagi.');
            
        } finally {
            $this->isSubmitting = false;
        }
    }

    public function getStepProgressProperty()
    {
        return round(($this->currentStep / $this->totalSteps) * 100);
    }

    public function render()
    {
        return view('livewire.auth.bidan-registration')
            ->layout('components.layouts.guest', ['title' => 'Daftar Sebagai Bidan']);
    }
}
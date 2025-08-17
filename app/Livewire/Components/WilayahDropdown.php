<?php

namespace App\Livewire\Components;

use Livewire\Component;
use App\Services\WilayahService;
use Livewire\Attributes\On;

class WilayahDropdown extends Component
{
    // Public properties for wire:model
    public $selectedProvince = '';
    public $selectedRegency = '';
    public $selectedDistrict = '';
    public $selectedVillage = '';
    
    // Data arrays
    public $provinces = [];
    public $regencies = [];
    public $districts = [];
    public $villages = [];
    
    // Configuration
    public $showProvince = true;
    public $showRegency = true;
    public $showDistrict = true;
    public $showVillage = true;
    
    // Labels
    public $provinceLabel = 'Provinsi';
    public $regencyLabel = 'Kabupaten/Kota';
    public $districtLabel = 'Kecamatan';
    public $villageLabel = 'Kelurahan/Desa';
    
    // Placeholders
    public $provincePlaceholder = 'Pilih Provinsi';
    public $regencyPlaceholder = 'Pilih Kabupaten/Kota';
    public $districtPlaceholder = 'Pilih Kecamatan';
    public $villagePlaceholder = 'Pilih Kelurahan/Desa';
    
    // CSS Classes
    public $containerClass = 'grid grid-cols-1 md:grid-cols-2 gap-4';
    public $inputClass = 'w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500';
    
    protected $wilayahService;
    
    public function boot(WilayahService $wilayahService)
    {
        $this->wilayahService = $wilayahService;
    }
    
    public function mount()
    {
        $this->loadProvinces();
        
        // Load initial data if values are set
        if ($this->selectedProvince) {
            $this->loadRegencies();
        }
        if ($this->selectedRegency) {
            $this->loadDistricts();
        }
        if ($this->selectedDistrict) {
            $this->loadVillages();
        }
    }
    
    public function loadProvinces()
    {
        $this->provinces = $this->wilayahService->getProvincesForSelect();
    }
    
    public function updatedSelectedProvince($value)
    {
        $this->selectedRegency = '';
        $this->selectedDistrict = '';
        $this->selectedVillage = '';
        
        $this->regencies = [];
        $this->districts = [];
        $this->villages = [];
        
        if ($value) {
            $this->loadRegencies();
        }
        
        $this->dispatch('wilayah-updated', [
            'province' => $value,
            'regency' => '',
            'district' => '',
            'village' => ''
        ]);
    }
    
    public function loadRegencies()
    {
        if ($this->selectedProvince) {
            $this->regencies = $this->wilayahService->getRegenciesForSelect($this->selectedProvince);
        }
    }
    
    public function updatedSelectedRegency($value)
    {
        $this->selectedDistrict = '';
        $this->selectedVillage = '';
        
        $this->districts = [];
        $this->villages = [];
        
        if ($value) {
            $this->loadDistricts();
        }
        
        $this->dispatch('wilayah-updated', [
            'province' => $this->selectedProvince,
            'regency' => $value,
            'district' => '',
            'village' => ''
        ]);
    }
    
    public function loadDistricts()
    {
        if ($this->selectedRegency) {
            $this->districts = $this->wilayahService->getDistrictsForSelect($this->selectedRegency);
        }
    }
    
    public function updatedSelectedDistrict($value)
    {
        $this->selectedVillage = '';
        $this->villages = [];
        
        if ($value) {
            $this->loadVillages();
        }
        
        $this->dispatch('wilayah-updated', [
            'province' => $this->selectedProvince,
            'regency' => $this->selectedRegency,
            'district' => $value,
            'village' => ''
        ]);
    }
    
    public function loadVillages()
    {
        if ($this->selectedDistrict) {
            $this->villages = $this->wilayahService->getVillagesForSelect($this->selectedDistrict);
        }
    }
    
    public function updatedSelectedVillage($value)
    {
        $this->dispatch('wilayah-updated', [
            'province' => $this->selectedProvince,
            'regency' => $this->selectedRegency,
            'district' => $this->selectedDistrict,
            'village' => $value
        ]);
    }
    
    public function getFullAddress()
    {
        if ($this->selectedProvince && $this->selectedRegency && $this->selectedDistrict && $this->selectedVillage) {
            return $this->wilayahService->getFullAddress(
                $this->selectedProvince,
                $this->selectedRegency,
                $this->selectedDistrict,
                $this->selectedVillage
            );
        }
        
        return '';
    }
    
    #[On('reset-wilayah')]
    public function resetSelections()
    {
        $this->selectedProvince = '';
        $this->selectedRegency = '';
        $this->selectedDistrict = '';
        $this->selectedVillage = '';
        
        $this->regencies = [];
        $this->districts = [];
        $this->villages = [];
    }
    
    public function render()
    {
        return view('livewire.components.wilayah-dropdown');
    }
}

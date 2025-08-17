<div class="{{ $containerClass }}">
    {{-- Province Dropdown --}}
    @if($showProvince)
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">{{ $provinceLabel }}</label>
            <select wire:model.live="selectedProvince" class="{{ $inputClass }}">
                <option value="">{{ $provincePlaceholder }}</option>
                @foreach($provinces as $province)
                    <option value="{{ $province['value'] }}">{{ $province['label'] }}</option>
                @endforeach
            </select>
            <div wire:loading wire:target="updatedSelectedProvince" class="text-sm text-gray-500 mt-1">
                Loading kabupaten/kota...
            </div>
        </div>
    @endif

    {{-- Regency Dropdown --}}
    @if($showRegency)
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">{{ $regencyLabel }}</label>
            <select wire:model.live="selectedRegency" class="{{ $inputClass }}" {{ !$selectedProvince ? 'disabled' : '' }}>
                <option value="">{{ $regencyPlaceholder }}</option>
                @foreach($regencies as $regency)
                    <option value="{{ $regency['value'] }}">{{ $regency['label'] }}</option>
                @endforeach
            </select>
            <div wire:loading wire:target="updatedSelectedRegency" class="text-sm text-gray-500 mt-1">
                Loading kecamatan...
            </div>
        </div>
    @endif

    {{-- District Dropdown --}}
    @if($showDistrict)
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">{{ $districtLabel }}</label>
            <select wire:model.live="selectedDistrict" class="{{ $inputClass }}" {{ !$selectedRegency ? 'disabled' : '' }}>
                <option value="">{{ $districtPlaceholder }}</option>
                @foreach($districts as $district)
                    <option value="{{ $district['value'] }}">{{ $district['label'] }}</option>
                @endforeach
            </select>
            <div wire:loading wire:target="updatedSelectedDistrict" class="text-sm text-gray-500 mt-1">
                Loading kelurahan/desa...
            </div>
        </div>
    @endif

    {{-- Village Dropdown --}}
    @if($showVillage)
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">{{ $villageLabel }}</label>
            <select wire:model.live="selectedVillage" class="{{ $inputClass }}" {{ !$selectedDistrict ? 'disabled' : '' }}>
                <option value="">{{ $villagePlaceholder }}</option>
                @foreach($villages as $village)
                    <option value="{{ $village['value'] }}">{{ $village['label'] }}</option>
                @endforeach
            </select>
        </div>
    @endif

    {{-- Full Address Preview --}}
    @if($selectedProvince && $selectedRegency && $selectedDistrict && $selectedVillage)
        <div class="md:col-span-2">
            <div class="bg-gray-50 p-3 rounded-lg border">
                <p class="text-sm font-medium text-gray-700 mb-1">Alamat Lengkap:</p>
                <p class="text-gray-900">{{ $this->getFullAddress() }}</p>
            </div>
        </div>
    @endif
</div>

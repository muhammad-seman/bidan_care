<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Collection;
use Exception;

class WilayahService
{
    // Use your deployed API
    private const BASE_URL = 'https://muhammad-seman.github.io/api-wilayah-indonesia/api';
    
    // Fallback to original API if needed
    private const FALLBACK_URL = 'https://emsifa.github.io/api-wilayah-indonesia/api';
    
    // Cache duration (24 hours)
    private const CACHE_TTL = 86400;
    
    /**
     * Get all provinces
     */
    public function getProvinces(): Collection
    {
        $cacheKey = 'wilayah.provinces';
        
        return Cache::remember($cacheKey, self::CACHE_TTL, function () {
            try {
                $response = Http::timeout(10)->get(self::BASE_URL . '/provinces.json');
                
                if ($response->successful()) {
                    return collect($response->json());
                }
                
                // Try fallback API
                $fallback = Http::timeout(10)->get(self::FALLBACK_URL . '/provinces.json');
                if ($fallback->successful()) {
                    return collect($fallback->json());
                }
                
                throw new Exception('Failed to fetch provinces from both APIs');
                
            } catch (Exception $e) {
                // Return empty collection with error logging
                \Log::error('Wilayah API Error - Provinces: ' . $e->getMessage());
                return collect([]);
            }
        });
    }
    
    /**
     * Get regencies by province ID
     */
    public function getRegencies(string $provinceId): Collection
    {
        $cacheKey = "wilayah.regencies.{$provinceId}";
        
        return Cache::remember($cacheKey, self::CACHE_TTL, function () use ($provinceId) {
            try {
                $response = Http::timeout(10)->get(self::BASE_URL . "/regencies/{$provinceId}.json");
                
                if ($response->successful()) {
                    return collect($response->json());
                }
                
                // Try fallback API
                $fallback = Http::timeout(10)->get(self::FALLBACK_URL . "/regencies/{$provinceId}.json");
                if ($fallback->successful()) {
                    return collect($fallback->json());
                }
                
                throw new Exception("Failed to fetch regencies for province {$provinceId}");
                
            } catch (Exception $e) {
                \Log::error("Wilayah API Error - Regencies for {$provinceId}: " . $e->getMessage());
                return collect([]);
            }
        });
    }
    
    /**
     * Get districts by regency ID
     */
    public function getDistricts(string $regencyId): Collection
    {
        $cacheKey = "wilayah.districts.{$regencyId}";
        
        return Cache::remember($cacheKey, self::CACHE_TTL, function () use ($regencyId) {
            try {
                $response = Http::timeout(10)->get(self::BASE_URL . "/districts/{$regencyId}.json");
                
                if ($response->successful()) {
                    return collect($response->json());
                }
                
                // Try fallback API
                $fallback = Http::timeout(10)->get(self::FALLBACK_URL . "/districts/{$regencyId}.json");
                if ($fallback->successful()) {
                    return collect($fallback->json());
                }
                
                throw new Exception("Failed to fetch districts for regency {$regencyId}");
                
            } catch (Exception $e) {
                \Log::error("Wilayah API Error - Districts for {$regencyId}: " . $e->getMessage());
                return collect([]);
            }
        });
    }
    
    /**
     * Get villages by district ID
     */
    public function getVillages(string $districtId): Collection
    {
        $cacheKey = "wilayah.villages.{$districtId}";
        
        return Cache::remember($cacheKey, self::CACHE_TTL, function () use ($districtId) {
            try {
                $response = Http::timeout(10)->get(self::BASE_URL . "/villages/{$districtId}.json");
                
                if ($response->successful()) {
                    return collect($response->json());
                }
                
                // Try fallback API
                $fallback = Http::timeout(10)->get(self::FALLBACK_URL . "/villages/{$districtId}.json");
                if ($fallback->successful()) {
                    return collect($fallback->json());
                }
                
                throw new Exception("Failed to fetch villages for district {$districtId}");
                
            } catch (Exception $e) {
                \Log::error("Wilayah API Error - Villages for {$districtId}: " . $e->getMessage());
                return collect([]);
            }
        });
    }
    
    /**
     * Get province name by ID
     */
    public function getProvinceName(string $provinceId): ?string
    {
        $provinces = $this->getProvinces();
        $province = $provinces->firstWhere('id', $provinceId);
        
        return $province['name'] ?? null;
    }
    
    /**
     * Get regency name by ID
     */
    public function getRegencyName(string $regencyId): ?string
    {
        // Extract province ID from regency ID (first 2 digits)
        $provinceId = substr($regencyId, 0, 2);
        $regencies = $this->getRegencies($provinceId);
        $regency = $regencies->firstWhere('id', $regencyId);
        
        return $regency['name'] ?? null;
    }
    
    /**
     * Get district name by ID
     */
    public function getDistrictName(string $districtId): ?string
    {
        // Extract regency ID from district ID (first 4 digits)
        $regencyId = substr($districtId, 0, 4);
        $districts = $this->getDistricts($regencyId);
        $district = $districts->firstWhere('id', $districtId);
        
        return $district['name'] ?? null;
    }
    
    /**
     * Get village name by ID
     */
    public function getVillageName(string $villageId): ?string
    {
        // Extract district ID from village ID (first 7 digits)
        $districtId = substr($villageId, 0, 7);
        $villages = $this->getVillages($districtId);
        $village = $villages->firstWhere('id', $villageId);
        
        return $village['name'] ?? null;
    }
    
    /**
     * Get full address string
     */
    public function getFullAddress(
        string $provinceId, 
        string $regencyId, 
        string $districtId, 
        string $villageId,
        string $detailedAddress = ''
    ): string {
        $parts = array_filter([
            $detailedAddress,
            $this->getVillageName($villageId),
            $this->getDistrictName($districtId),
            $this->getRegencyName($regencyId),
            $this->getProvinceName($provinceId)
        ]);
        
        return implode(', ', $parts);
    }
    
    /**
     * Search provinces by name
     */
    public function searchProvinces(string $query): Collection
    {
        $provinces = $this->getProvinces();
        
        return $provinces->filter(function ($province) use ($query) {
            return stripos($province['name'], $query) !== false;
        });
    }
    
    /**
     * Search regencies by name within province
     */
    public function searchRegencies(string $provinceId, string $query): Collection
    {
        $regencies = $this->getRegencies($provinceId);
        
        return $regencies->filter(function ($regency) use ($query) {
            return stripos($regency['name'], $query) !== false;
        });
    }
    
    /**
     * Clear all wilayah cache
     */
    public function clearCache(): void
    {
        $cacheKeys = [
            'wilayah.provinces',
        ];
        
        foreach ($cacheKeys as $key) {
            Cache::forget($key);
        }
        
        // Clear regencies, districts, villages cache with pattern
        Cache::flush(); // Or implement more specific cache clearing
    }
    
    /**
     * Check if API is healthy
     */
    public function isHealthy(): bool
    {
        try {
            $response = Http::timeout(5)->get(self::BASE_URL . '/provinces.json');
            return $response->successful();
        } catch (Exception $e) {
            return false;
        }
    }
    
    /**
     * Get provinces formatted for select dropdown
     */
    public function getProvincesForSelect(): array
    {
        return $this->getProvinces()
            ->map(fn($province) => [
                'value' => $province['id'],
                'label' => $province['name']
            ])
            ->sortBy('label')
            ->values()
            ->all();
    }
    
    /**
     * Get regencies formatted for select dropdown
     */
    public function getRegenciesForSelect(string $provinceId): array
    {
        return $this->getRegencies($provinceId)
            ->map(fn($regency) => [
                'value' => $regency['id'],
                'label' => $regency['name']
            ])
            ->sortBy('label')
            ->values()
            ->all();
    }
    
    /**
     * Get districts formatted for select dropdown
     */
    public function getDistrictsForSelect(string $regencyId): array
    {
        return $this->getDistricts($regencyId)
            ->map(fn($district) => [
                'value' => $district['id'],
                'label' => $district['name']
            ])
            ->sortBy('label')
            ->values()
            ->all();
    }
    
    /**
     * Get villages formatted for select dropdown
     */
    public function getVillagesForSelect(string $districtId): array
    {
        return $this->getVillages($districtId)
            ->map(fn($village) => [
                'value' => $village['id'],
                'label' => $village['name']
            ])
            ->sortBy('label')
            ->values()
            ->all();
    }
}
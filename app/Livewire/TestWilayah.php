<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Services\WilayahService;

class TestWilayah extends Component
{
    public $selectedData = [];
    public $fullAddress = '';
    
    protected $wilayahService;
    
    public function boot(WilayahService $wilayahService)
    {
        $this->wilayahService = $wilayahService;
    }
    
    #[On('wilayah-updated')]
    public function handleWilayahUpdate($data)
    {
        $this->selectedData = $data;
        
        if ($data['province'] && $data['regency'] && $data['district'] && $data['village']) {
            $this->fullAddress = $this->wilayahService->getFullAddress(
                $data['province'],
                $data['regency'],
                $data['district'],
                $data['village']
            );
        } else {
            $this->fullAddress = '';
        }
    }
    
    public function render()
    {
        return view('livewire.test-wilayah')
            ->layout('components.layouts.app', ['title' => 'Test Wilayah API']);
    }
}

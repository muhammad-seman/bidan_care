<x-layouts.app :title="__('Dashboard')">
    @if(auth()->user()->isAdmin())
        @include('dashboard.admin')
    @elseif(auth()->user()->isBidan())
        <livewire:bidan.dashboard />
    @else
        @include('dashboard.pasien')
    @endif
</x-layouts.app>

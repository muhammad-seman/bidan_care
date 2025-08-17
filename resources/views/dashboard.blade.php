<x-layouts.app :title="__('Dashboard')">
    @if(auth()->user()->isAdmin())
        @include('dashboard.admin')
    @elseif(auth()->user()->isBidan())
        @include('dashboard.bidan')
    @else
        @include('dashboard.pasien')
    @endif
</x-layouts.app>

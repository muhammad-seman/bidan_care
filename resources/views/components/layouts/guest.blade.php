<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.head')
        <title>{{ $title ?? config('app.name', 'HomeCare') }}</title>
    </head>
    <body class="min-h-screen bg-white antialiased">
        <div class="min-h-screen flex flex-col">
            {{-- Navigation --}}
            <nav class="bg-white/80 backdrop-blur-md border-b border-pink-100 sticky top-0 z-50">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between items-center h-16">
                        {{-- Logo --}}
                        <a href="{{ route('home') }}" class="flex items-center space-x-3" wire:navigate>
                            <div class="w-10 h-10 bg-gradient-to-r from-pink-500 to-rose-500 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h1 class="text-xl font-bold text-gray-900">HomeCare</h1>
                                <p class="text-xs text-gray-600">Platform Bidan Terpercaya</p>
                            </div>
                        </a>

                        {{-- Auth Links --}}
                        <div class="flex items-center space-x-4">
                            <a href="{{ route('login') }}" 
                               class="text-gray-700 hover:text-pink-600 font-medium transition-colors">
                                Masuk
                            </a>
                            
                            <a href="{{ route('register') }}" 
                               class="text-gray-700 hover:text-pink-600 font-medium transition-colors">
                                Daftar Pasien
                            </a>
                        </div>
                    </div>
                </div>
            </nav>

            {{-- Main Content --}}
            <main class="flex-1">
                {{ $slot }}
            </main>

            {{-- Footer --}}
            <footer class="bg-white/80 backdrop-blur-md border-t border-pink-100 mt-auto">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                    <div class="text-center">
                        <div class="flex items-center justify-center space-x-3 mb-3">
                            <div class="w-6 h-6 bg-gradient-to-r from-pink-500 to-rose-500 rounded-lg flex items-center justify-center">
                                <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                </svg>
                            </div>
                            <span class="font-bold text-gray-900">HomeCare</span>
                        </div>
                        <p class="text-gray-600 text-sm">&copy; {{ date('Y') }} HomeCare. Platform Booking Bidan Terpercaya.</p>
                    </div>
                </div>
            </footer>
        </div>
        
        @fluxScripts
    </body>
</html>
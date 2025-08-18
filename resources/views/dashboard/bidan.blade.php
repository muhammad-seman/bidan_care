{{-- Bidan Dashboard --}}
<div class="space-y-8">
    {{-- Welcome Section --}}
    <div class="bg-gradient-to-r from-pink-500 to-rose-500 rounded-2xl p-8 text-white">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold mb-2">Selamat Datang, {{ auth()->user()->name }}</h1>
                <p class="text-pink-100 text-lg">Dashboard Bidan HomeCare</p>
            </div>
            <div class="w-16 h-16 bg-white/20 rounded-xl flex items-center justify-center">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
            </div>
        </div>
    </div>

    {{-- Stats Overview --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="bg-white rounded-xl p-6 border border-gray-200 hover:shadow-lg transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Booking Hari Ini</p>
                    <p class="text-2xl font-bold text-gray-900">5</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl p-6 border border-gray-200 hover:shadow-lg transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Total Pasien</p>
                    <p class="text-2xl font-bold text-gray-900">89</p>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl p-6 border border-gray-200 hover:shadow-lg transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Pendapatan Bulan Ini</p>
                    <p class="text-2xl font-bold text-gray-900">Rp 12.5M</p>
                </div>
                <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl p-6 border border-gray-200 hover:shadow-lg transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Rating Rata-rata</p>
                    <p class="text-2xl font-bold text-gray-900">4.8</p>
                </div>
                <div class="w-12 h-12 bg-pink-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    {{-- Today's Schedule & Quick Actions --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        {{-- Today's Schedule --}}
        <div class="bg-white rounded-xl border border-gray-200">
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-900">Jadwal Hari Ini</h3>
                    <span class="text-sm text-gray-600">{{ date('d M Y') }}</span>
                </div>
            </div>
            <div class="p-6 space-y-4">
                <div class="flex items-center space-x-4 p-4 bg-blue-50 rounded-lg border border-blue-200">
                    <div class="w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center">
                        <span class="text-white font-semibold">IR</span>
                    </div>
                    <div class="flex-1">
                        <p class="font-medium text-gray-900">Ibu Rina</p>
                        <p class="text-sm text-gray-600">Konsultasi Kehamilan</p>
                        <p class="text-xs text-blue-600 font-medium">09:00 - 10:00 WIB</p>
                    </div>
                    <div class="flex space-x-2">
                        <button class="px-3 py-1 bg-green-600 text-white rounded-md text-sm hover:bg-green-700">
                            Mulai
                        </button>
                    </div>
                </div>

                <div class="flex items-center space-x-4 p-4 bg-green-50 rounded-lg border border-green-200">
                    <div class="w-12 h-12 bg-green-500 rounded-full flex items-center justify-center">
                        <span class="text-white font-semibold">IS</span>
                    </div>
                    <div class="flex-1">
                        <p class="font-medium text-gray-900">Ibu Sari</p>
                        <p class="text-sm text-gray-600">Kunjungan Rumah</p>
                        <p class="text-xs text-green-600 font-medium">14:00 - 15:00 WIB</p>
                    </div>
                    <div class="flex space-x-2">
                        <button class="px-3 py-1 bg-blue-600 text-white rounded-md text-sm hover:bg-blue-700">
                            Detail
                        </button>
                    </div>
                </div>

                <div class="flex items-center space-x-4 p-4 bg-yellow-50 rounded-lg border border-yellow-200">
                    <div class="w-12 h-12 bg-yellow-500 rounded-full flex items-center justify-center">
                        <span class="text-white font-semibold">ID</span>
                    </div>
                    <div class="flex-1">
                        <p class="font-medium text-gray-900">Ibu Dewi</p>
                        <p class="text-sm text-gray-600">Perawatan Pasca Melahirkan</p>
                        <p class="text-xs text-yellow-600 font-medium">16:30 - 17:30 WIB</p>
                    </div>
                    <div class="flex space-x-2">
                        <button class="px-3 py-1 bg-blue-600 text-white rounded-md text-sm hover:bg-blue-700">
                            Detail
                        </button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Recent Reviews --}}
        <div class="bg-white rounded-xl border border-gray-200">
            <div class="p-6 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Review Terbaru</h3>
            </div>
            <div class="p-6 space-y-4">
                <div class="p-4 bg-gray-50 rounded-lg">
                    <div class="flex items-center justify-between mb-2">
                        <div class="flex items-center space-x-2">
                            <div class="w-8 h-8 bg-pink-500 rounded-full flex items-center justify-center">
                                <span class="text-white text-sm font-semibold">IA</span>
                            </div>
                            <span class="font-medium text-gray-900">Ibu Ani</span>
                        </div>
                        <div class="flex text-yellow-400">
                            ⭐⭐⭐⭐⭐
                        </div>
                    </div>
                    <p class="text-sm text-gray-600">"Pelayanan sangat memuaskan. Bidan sangat profesional dan ramah. Terima kasih!"</p>
                </div>

                <div class="p-4 bg-gray-50 rounded-lg">
                    <div class="flex items-center justify-between mb-2">
                        <div class="flex items-center space-x-2">
                            <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center">
                                <span class="text-white text-sm font-semibold">IL</span>
                            </div>
                            <span class="font-medium text-gray-900">Ibu Linda</span>
                        </div>
                        <div class="flex text-yellow-400">
                            ⭐⭐⭐⭐⭐
                        </div>
                    </div>
                    <p class="text-sm text-gray-600">"Kunjungan rumah sangat membantu. Bidan datang tepat waktu dan memberikan pelayanan terbaik."</p>
                </div>

                <div class="p-4 bg-gray-50 rounded-lg">
                    <div class="flex items-center justify-between mb-2">
                        <div class="flex items-center space-x-2">
                            <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center">
                                <span class="text-white text-sm font-semibold">IM</span>
                            </div>
                            <span class="font-medium text-gray-900">Ibu Maya</span>
                        </div>
                        <div class="flex text-yellow-400">
                            ⭐⭐⭐⭐⭐
                        </div>
                    </div>
                    <p class="text-sm text-gray-600">"Konsultasi kehamilan sangat detail dan informatif. Sangat direkomendasikan!"</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Quick Management Links --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <a href="#" class="bg-white p-6 rounded-xl border border-gray-200 hover:shadow-lg transition-all duration-200 text-center group">
            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mx-auto mb-4 group-hover:bg-blue-200 transition-colors">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
            </div>
            <h4 class="font-semibold text-gray-900 mb-2">Kelola Jadwal</h4>
            <p class="text-sm text-gray-600">Atur availability & booking</p>
        </a>

        <a href="{{ route('bidan.services') }}" class="bg-white p-6 rounded-xl border border-gray-200 hover:shadow-lg transition-all duration-200 text-center group">
            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mx-auto mb-4 group-hover:bg-green-200 transition-colors">
                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                </svg>
            </div>
            <h4 class="font-semibold text-gray-900 mb-2">Layanan Saya</h4>
            <p class="text-sm text-gray-600">Kelola layanan & harga</p>
        </a>

        <a href="#" class="bg-white p-6 rounded-xl border border-gray-200 hover:shadow-lg transition-all duration-200 text-center group">
            <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mx-auto mb-4 group-hover:bg-purple-200 transition-colors">
                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
            </div>
            <h4 class="font-semibold text-gray-900 mb-2">Profil Saya</h4>
            <p class="text-sm text-gray-600">Edit profil & portfolio</p>
        </a>

        <a href="#" class="bg-white p-6 rounded-xl border border-gray-200 hover:shadow-lg transition-all duration-200 text-center group">
            <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center mx-auto mb-4 group-hover:bg-yellow-200 transition-colors">
                <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
            </div>
            <h4 class="font-semibold text-gray-900 mb-2">Laporan</h4>
            <p class="text-sm text-gray-600">Pendapatan & statistik</p>
        </a>
    </div>
</div>
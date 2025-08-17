{{-- Pasien Dashboard --}}
<div class="space-y-8">
    {{-- Welcome Section --}}
    <div class="bg-gradient-to-r from-teal-500 to-cyan-500 rounded-2xl p-8 text-white">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold mb-2">Selamat Datang, {{ auth()->user()->name }}</h1>
                <p class="text-teal-100 text-lg">Dashboard Pasien HomeCare</p>
            </div>
            <div class="w-16 h-16 bg-white/20 rounded-xl flex items-center justify-center">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                </svg>
            </div>
        </div>
    </div>

    {{-- Quick Stats --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white rounded-xl p-6 border border-gray-200 hover:shadow-lg transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Booking Mendatang</p>
                    <p class="text-2xl font-bold text-gray-900">2</p>
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
                    <p class="text-gray-600 text-sm font-medium">Total Konsultasi</p>
                    <p class="text-2xl font-bold text-gray-900">12</p>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl p-6 border border-gray-200 hover:shadow-lg transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Bidan Favorit</p>
                    <p class="text-2xl font-bold text-gray-900">3</p>
                </div>
                <div class="w-12 h-12 bg-pink-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    {{-- Upcoming Appointments & Find Bidan --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        {{-- Upcoming Appointments --}}
        <div class="bg-white rounded-xl border border-gray-200">
            <div class="p-6 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Jadwal Mendatang</h3>
            </div>
            <div class="p-6 space-y-4">
                <div class="flex items-center space-x-4 p-4 bg-blue-50 rounded-lg border border-blue-200">
                    <div class="w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center">
                        <span class="text-white font-semibold">BS</span>
                    </div>
                    <div class="flex-1">
                        <p class="font-medium text-gray-900">Bidan Sari</p>
                        <p class="text-sm text-gray-600">Konsultasi Kehamilan</p>
                        <p class="text-xs text-blue-600 font-medium">Besok, 09:00 WIB</p>
                    </div>
                    <div class="flex space-x-2">
                        <button class="px-3 py-1 bg-blue-600 text-white rounded-md text-sm hover:bg-blue-700">
                            Detail
                        </button>
                    </div>
                </div>

                <div class="flex items-center space-x-4 p-4 bg-green-50 rounded-lg border border-green-200">
                    <div class="w-12 h-12 bg-green-500 rounded-full flex items-center justify-center">
                        <span class="text-white font-semibold">BA</span>
                    </div>
                    <div class="flex-1">
                        <p class="font-medium text-gray-900">Bidan Ayu</p>
                        <p class="text-sm text-gray-600">Kunjungan Rumah</p>
                        <p class="text-xs text-green-600 font-medium">25 Agt, 14:00 WIB</p>
                    </div>
                    <div class="flex space-x-2">
                        <button class="px-3 py-1 bg-green-600 text-white rounded-md text-sm hover:bg-green-700">
                            Detail
                        </button>
                    </div>
                </div>

                <div class="text-center py-4">
                    <a href="#" class="text-blue-600 hover:text-blue-800 font-medium text-sm">
                        Lihat Semua Jadwal →
                    </a>
                </div>
            </div>
        </div>

        {{-- Find Bidan Section --}}
        <div class="bg-white rounded-xl border border-gray-200">
            <div class="p-6 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Cari Bidan</h3>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Layanan</label>
                        <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500">
                            <option>Konsultasi Kehamilan</option>
                            <option>Kunjungan Rumah</option>
                            <option>Perawatan Pasca Melahirkan</option>
                            <option>Pemeriksaan Rutin</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Lokasi</label>
                        <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500">
                            <option>Jakarta Selatan</option>
                            <option>Jakarta Pusat</option>
                            <option>Jakarta Utara</option>
                            <option>Jakarta Barat</option>
                            <option>Jakarta Timur</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal</label>
                        <input type="date" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500">
                    </div>

                    <button class="w-full bg-gradient-to-r from-teal-500 to-cyan-500 text-white py-3 rounded-lg font-semibold hover:from-teal-600 hover:to-cyan-600 transition-all duration-200">
                        Cari Bidan
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Medical Records & Recent Activity --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        {{-- Medical Records Summary --}}
        <div class="bg-white rounded-xl border border-gray-200">
            <div class="p-6 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Riwayat Medis Terbaru</h3>
            </div>
            <div class="p-6 space-y-4">
                <div class="p-4 bg-gray-50 rounded-lg">
                    <div class="flex items-center justify-between mb-2">
                        <span class="font-medium text-gray-900">Konsultasi Kehamilan</span>
                        <span class="text-sm text-gray-600">15 Agt 2025</span>
                    </div>
                    <p class="text-sm text-gray-600 mb-2">Bidan: Sari Pertiwi</p>
                    <p class="text-sm text-gray-600">Pemeriksaan rutin kehamilan trimester 2. Kondisi ibu dan janin sehat.</p>
                </div>

                <div class="p-4 bg-gray-50 rounded-lg">
                    <div class="flex items-center justify-between mb-2">
                        <span class="font-medium text-gray-900">Kunjungan Rumah</span>
                        <span class="text-sm text-gray-600">28 Jul 2025</span>
                    </div>
                    <p class="text-sm text-gray-600 mb-2">Bidan: Ayu Lestari</p>
                    <p class="text-sm text-gray-600">Pemeriksaan post-natal. Recovery berjalan dengan baik.</p>
                </div>

                <div class="text-center pt-2">
                    <a href="#" class="text-teal-600 hover:text-teal-800 font-medium text-sm">
                        Lihat Semua Riwayat →
                    </a>
                </div>
            </div>
        </div>

        {{-- Favorite Bidan --}}
        <div class="bg-white rounded-xl border border-gray-200">
            <div class="p-6 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Bidan Favorit</h3>
            </div>
            <div class="p-6 space-y-4">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-pink-500 rounded-full flex items-center justify-center">
                        <span class="text-white font-semibold">SP</span>
                    </div>
                    <div class="flex-1">
                        <p class="font-medium text-gray-900">Sari Pertiwi</p>
                        <p class="text-sm text-gray-600">Spesialis Kehamilan</p>
                        <div class="flex text-yellow-400 text-sm">
                            ⭐⭐⭐⭐⭐ (4.9)
                        </div>
                    </div>
                    <button class="px-4 py-2 bg-pink-600 text-white rounded-lg text-sm hover:bg-pink-700">
                        Booking
                    </button>
                </div>

                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center">
                        <span class="text-white font-semibold">AL</span>
                    </div>
                    <div class="flex-1">
                        <p class="font-medium text-gray-900">Ayu Lestari</p>
                        <p class="text-sm text-gray-600">Perawatan Post-natal</p>
                        <div class="flex text-yellow-400 text-sm">
                            ⭐⭐⭐⭐⭐ (4.8)
                        </div>
                    </div>
                    <button class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm hover:bg-blue-700">
                        Booking
                    </button>
                </div>

                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-green-500 rounded-full flex items-center justify-center">
                        <span class="text-white font-semibold">DR</span>
                    </div>
                    <div class="flex-1">
                        <p class="font-medium text-gray-900">Dewi Rahayu</p>
                        <p class="text-sm text-gray-600">Konsultasi Umum</p>
                        <div class="flex text-yellow-400 text-sm">
                            ⭐⭐⭐⭐⭐ (4.7)
                        </div>
                    </div>
                    <button class="px-4 py-2 bg-green-600 text-white rounded-lg text-sm hover:bg-green-700">
                        Booking
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Quick Actions --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <a href="#" class="bg-white p-6 rounded-xl border border-gray-200 hover:shadow-lg transition-all duration-200 text-center group">
            <div class="w-12 h-12 bg-teal-100 rounded-lg flex items-center justify-center mx-auto mb-4 group-hover:bg-teal-200 transition-colors">
                <svg class="w-6 h-6 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
            <h4 class="font-semibold text-gray-900 mb-2">Cari Bidan</h4>
            <p class="text-sm text-gray-600">Temukan bidan terdekat</p>
        </a>

        <a href="#" class="bg-white p-6 rounded-xl border border-gray-200 hover:shadow-lg transition-all duration-200 text-center group">
            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mx-auto mb-4 group-hover:bg-blue-200 transition-colors">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
            </div>
            <h4 class="font-semibold text-gray-900 mb-2">Jadwal Saya</h4>
            <p class="text-sm text-gray-600">Lihat semua appointment</p>
        </a>

        <a href="#" class="bg-white p-6 rounded-xl border border-gray-200 hover:shadow-lg transition-all duration-200 text-center group">
            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mx-auto mb-4 group-hover:bg-green-200 transition-colors">
                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
            </div>
            <h4 class="font-semibold text-gray-900 mb-2">Riwayat Medis</h4>
            <p class="text-sm text-gray-600">Akses catatan kesehatan</p>
        </a>

        <a href="#" class="bg-white p-6 rounded-xl border border-gray-200 hover:shadow-lg transition-all duration-200 text-center group">
            <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mx-auto mb-4 group-hover:bg-purple-200 transition-colors">
                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
            </div>
            <h4 class="font-semibold text-gray-900 mb-2">Profil Saya</h4>
            <p class="text-sm text-gray-600">Edit informasi pribadi</p>
        </a>
    </div>
</div>
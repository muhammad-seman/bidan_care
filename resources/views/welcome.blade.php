<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'HomeCare') }} - Platform Booking Bidan Terpercaya</title>
        <link rel="icon" href="/favicon.ico" sizes="any">
        <link rel="icon" href="/favicon.svg" type="image/svg+xml">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">
        
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />
        
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-gradient-to-br from-pink-50 via-white to-blue-50 text-gray-900 min-h-screen">
        <!-- Navigation -->
        <nav class="bg-white/80 backdrop-blur-md border-b border-pink-100 sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <!-- Logo -->
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-gradient-to-r from-pink-500 to-rose-500 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-xl font-bold text-gray-900">HomeCare</h1>
                            <p class="text-xs text-gray-600">Platform Bidan Terpercaya</p>
                        </div>
                    </div>

                    <!-- Auth Links -->
                    @if (Route::has('login'))
                        <div class="flex items-center space-x-4">
                            @auth
                                <a href="{{ url('/dashboard') }}" 
                                   class="bg-gradient-to-r from-pink-500 to-rose-500 text-white px-6 py-2 rounded-full font-medium hover:from-pink-600 hover:to-rose-600 transition-all duration-200 shadow-lg">
                                    Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}" 
                                   class="text-gray-700 hover:text-pink-600 font-medium transition-colors">
                                    Masuk
                                </a>
                                
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" 
                                       class="bg-gradient-to-r from-pink-500 to-rose-500 text-white px-6 py-2 rounded-full font-medium hover:from-pink-600 hover:to-rose-600 transition-all duration-200 shadow-lg">
                                        Daftar Sekarang
                                    </a>
                                @endif
                            @endauth
                        </div>
                    @endif
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="text-center space-y-8 mb-16">
                <div class="space-y-4">
                    <h2 class="text-5xl md:text-6xl font-bold text-gray-900 leading-tight">
                        Temukan <span class="text-transparent bg-clip-text bg-gradient-to-r from-pink-500 to-rose-500">Bidan Terpercaya</span><br>
                        di Sekitar Anda
                    </h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                        Platform booking bidan profesional untuk kebutuhan kesehatan ibu dan anak. 
                        Layanan berkualitas, terpercaya, dan mudah diakses kapan saja.
                    </p>
                </div>

                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                    @guest
                        <a href="{{ route('register') }}" 
                           class="bg-gradient-to-r from-pink-500 to-rose-500 text-white px-8 py-4 rounded-full text-lg font-semibold hover:from-pink-600 hover:to-rose-600 transition-all duration-200 shadow-xl hover:shadow-2xl transform hover:-translate-y-1">
                            Mulai Booking Sekarang
                        </a>
                        <a href="#features" 
                           class="text-gray-700 hover:text-pink-600 font-semibold text-lg transition-colors">
                            Pelajari Lebih Lanjut →
                        </a>
                    @else
                        <a href="{{ url('/dashboard') }}" 
                           class="bg-gradient-to-r from-pink-500 to-rose-500 text-white px-8 py-4 rounded-full text-lg font-semibold hover:from-pink-600 hover:to-rose-600 transition-all duration-200 shadow-xl hover:shadow-2xl transform hover:-translate-y-1">
                            Ke Dashboard
                        </a>
                    @endguest
                </div>
            </div>

            <!-- Features Section -->
            <section id="features" class="grid md:grid-cols-3 gap-8 mb-16">
                <div class="bg-white/60 backdrop-blur-sm p-8 rounded-2xl border border-pink-100 hover:shadow-xl transition-all duration-300 hover:-translate-y-2">
                    <div class="w-12 h-12 bg-gradient-to-r from-pink-500 to-rose-500 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Booking Mudah</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Sistem booking berbasis slot waktu yang memudahkan Anda memilih jadwal yang sesuai dengan kebutuhan.
                    </p>
                </div>

                <div class="bg-white/60 backdrop-blur-sm p-8 rounded-2xl border border-pink-100 hover:shadow-xl transition-all duration-300 hover:-translate-y-2">
                    <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-purple-500 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Bidan Terverifikasi</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Semua bidan telah melalui proses verifikasi sertifikat dan lisensi untuk memastikan kualitas layanan terbaik.
                    </p>
                </div>

                <div class="bg-white/60 backdrop-blur-sm p-8 rounded-2xl border border-pink-100 hover:shadow-xl transition-all duration-300 hover:-translate-y-2">
                    <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-teal-500 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Pembayaran Aman</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Sistem escrow yang aman melindungi transaksi Anda. Dana akan diteruskan ke bidan setelah layanan selesai.
                    </p>
                </div>
            </section>

            <!-- Service Types -->
            <section class="bg-white/40 backdrop-blur-sm rounded-3xl p-12 border border-pink-100 mb-16">
                <div class="text-center mb-12">
                    <h3 class="text-3xl font-bold text-gray-900 mb-4">Layanan yang Tersedia</h3>
                    <p class="text-gray-600 text-lg">Berbagai layanan kesehatan ibu dan anak dengan bidan profesional</p>
                </div>

                <div class="grid md:grid-cols-2 gap-8">
                    <div class="flex items-start space-x-4">
                        <div class="w-8 h-8 bg-pink-500 rounded-lg flex items-center justify-center flex-shrink-0 mt-1">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-900 mb-2">Kunjungan Rumah</h4>
                            <p class="text-gray-600">Layanan bidan datang langsung ke rumah Anda untuk kenyamanan maksimal.</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-4">
                        <div class="w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center flex-shrink-0 mt-1">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-900 mb-2">Kunjungan Klinik</h4>
                            <p class="text-gray-600">Konsultasi di klinik bidan dengan fasilitas medis yang lengkap.</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-4">
                        <div class="w-8 h-8 bg-green-500 rounded-lg flex items-center justify-center flex-shrink-0 mt-1">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-900 mb-2">Konsultasi Kehamilan</h4>
                            <p class="text-gray-600">Pemeriksaan rutin kehamilan dengan monitoring kesehatan ibu dan janin.</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-4">
                        <div class="w-8 h-8 bg-purple-500 rounded-lg flex items-center justify-center flex-shrink-0 mt-1">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-900 mb-2">Perawatan Pasca Melahirkan</h4>
                            <p class="text-gray-600">Pendampingan dan perawatan setelah melahirkan untuk ibu dan bayi.</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- CTA Section -->
            <section class="text-center">
                <div class="bg-gradient-to-r from-pink-500 to-rose-500 rounded-3xl p-12 text-white">
                    <h3 class="text-3xl font-bold mb-4">Siap Memulai Perjalanan Kesehatan Anda?</h3>
                    <p class="text-pink-100 text-lg mb-8 max-w-2xl mx-auto">
                        Bergabunglah dengan ribuan ibu yang telah mempercayakan kesehatan mereka kepada bidan profesional melalui platform kami.
                    </p>
                    @guest
                        <a href="{{ route('register') }}" 
                           class="bg-white text-pink-600 px-8 py-4 rounded-full text-lg font-semibold hover:bg-gray-50 transition-all duration-200 shadow-xl hover:shadow-2xl transform hover:-translate-y-1 inline-block">
                            Daftar Gratis Sekarang
                        </a>
                    @else
                        <a href="{{ url('/dashboard') }}" 
                           class="bg-white text-pink-600 px-8 py-4 rounded-full text-lg font-semibold hover:bg-gray-50 transition-all duration-200 shadow-xl hover:shadow-2xl transform hover:-translate-y-1 inline-block">
                            Mulai Booking
                        </a>
                    @endguest
                </div>
            </section>
        </main>

        <!-- Footer -->
        <footer class="bg-white/80 backdrop-blur-md border-t border-pink-100 mt-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div class="text-center">
                    <div class="flex items-center justify-center space-x-3 mb-4">
                        <div class="w-8 h-8 bg-gradient-to-r from-pink-500 to-rose-500 rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                        </div>
                        <span class="font-bold text-gray-900">HomeCare</span>
                    </div>
                    <p class="text-gray-600">&copy; {{ date('Y') }} HomeCare. Platform Booking Bidan Terpercaya.</p>
                </div>
            </div>
        </footer>
    </body>
</html>
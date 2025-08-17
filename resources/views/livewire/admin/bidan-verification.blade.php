<div class="max-w-7xl mx-auto p-6">
    {{-- Header --}}
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Verifikasi Bidan</h1>
        <p class="text-gray-600">Kelola dan verifikasi pendaftaran bidan baru</p>
    </div>

    {{-- Statistics Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="p-2 bg-blue-100 rounded-lg">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Bidan</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['total'] }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="p-2 bg-yellow-100 rounded-lg">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Menunggu</p>
                    <p class="text-2xl font-bold text-yellow-600">{{ $stats['pending'] }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="p-2 bg-green-100 rounded-lg">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Terverifikasi</p>
                    <p class="text-2xl font-bold text-green-600">{{ $stats['verified'] }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="p-2 bg-red-100 rounded-lg">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Ditolak</p>
                    <p class="text-2xl font-bold text-red-600">{{ $stats['rejected'] }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Filters & Search --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-8">
        <div class="flex flex-col md:flex-row gap-4">
            {{-- Search --}}
            <div class="flex-1">
                <input type="text" 
                       wire:model.live.debounce.300ms="search" 
                       placeholder="Cari berdasarkan nama, email, STR, atau spesialisasi..."
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>

            {{-- Status Filter --}}
            <div class="md:w-48">
                <select wire:model.live="statusFilter" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="all">Semua Status</option>
                    <option value="pending">Menunggu</option>
                    <option value="verified">Terverifikasi</option>
                    <option value="rejected">Ditolak</option>
                </select>
            </div>
        </div>
    </div>

    {{-- Bidan List --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        @if($bidanProfiles->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bidan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">STR & Spesialisasi</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lokasi</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Daftar</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($bidanProfiles as $bidan)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="h-12 w-12 bg-gradient-to-r from-pink-500 to-rose-500 rounded-full flex items-center justify-center">
                                            <span class="text-white font-semibold text-lg">
                                                {{ substr($bidan->user->name, 0, 1) }}
                                            </span>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $bidan->user->name }}</div>
                                            <div class="text-sm text-gray-500">{{ $bidan->user->email }}</div>
                                            <div class="text-sm text-gray-500">{{ $bidan->user->phone }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">STR: {{ $bidan->license_number }}</div>
                                    <div class="text-sm text-gray-500">{{ $bidan->specialization }}</div>
                                    <div class="text-sm text-gray-500">{{ $bidan->experience_years }} tahun pengalaman</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900">{{ $bidan->detailed_address }}</div>
                                    <div class="text-sm text-gray-500">{{ substr($bidan->detailed_address, 0, 50) }}...</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($bidan->verification_status === 'pending')
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                            Menunggu
                                        </span>
                                    @elseif($bidan->verification_status === 'verified')
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                            Terverifikasi
                                        </span>
                                    @else
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                            Ditolak
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $bidan->created_at->format('d M Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <button wire:click="viewBidanDetails({{ $bidan->id }})"
                                            class="bg-blue-500 text-white px-3 py-1 rounded-lg text-sm hover:bg-blue-600 transition-colors">
                                        Review
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $bidanProfiles->links() }}
            </div>
        @else
            <div class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada data</h3>
                <p class="mt-1 text-sm text-gray-500">Belum ada bidan yang mendaftar sesuai filter.</p>
            </div>
        @endif
    </div>

    {{-- Verification Modal --}}
    @if($showModal && $selectedBidan)
        <div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50" 
             wire:click="closeModal">
            <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white"
                 wire:click.stop>
                
                {{-- Modal Header --}}
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-bold text-gray-900">Review Bidan: {{ $selectedBidan->user->name }}</h3>
                    <button wire:click="closeModal" 
                            class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                {{-- Modal Content --}}
                <div class="space-y-6 max-h-96 overflow-y-auto">
                    {{-- Personal Info --}}
                    <div class="grid md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                            <p class="text-gray-900">{{ $selectedBidan->user->name }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <p class="text-gray-900">{{ $selectedBidan->user->email }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Telepon</label>
                            <p class="text-gray-900">{{ $selectedBidan->user->phone }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">STR</label>
                            <p class="text-gray-900">{{ $selectedBidan->license_number }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Spesialisasi</label>
                            <p class="text-gray-900">{{ $selectedBidan->specialization }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Pengalaman</label>
                            <p class="text-gray-900">{{ $selectedBidan->experience_years }} tahun</p>
                        </div>
                    </div>

                    {{-- Bio --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Bio</label>
                        <p class="text-gray-900 bg-gray-50 p-3 rounded-lg">{{ $selectedBidan->bio }}</p>
                    </div>

                    {{-- Address --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Alamat Lengkap</label>
                        <p class="text-gray-900 bg-gray-50 p-3 rounded-lg">{{ $this->fullAddress }}</p>
                    </div>

                    {{-- Documents --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-3">Dokumen</label>
                        <div class="grid md:grid-cols-2 gap-4">
                            <div class="border border-gray-200 rounded-lg p-4">
                                <h4 class="font-medium text-gray-900 mb-2">Dokumen STR</h4>
                                @if($selectedBidan->license_document_url)
                                    <button wire:click="downloadDocument('license')"
                                            class="text-blue-500 hover:text-blue-700 text-sm">
                                        📄 Download Dokumen STR
                                    </button>
                                @else
                                    <span class="text-red-500 text-sm">Dokumen tidak tersedia</span>
                                @endif
                            </div>
                            <div class="border border-gray-200 rounded-lg p-4">
                                <h4 class="font-medium text-gray-900 mb-2">Sertifikat Kompetensi</h4>
                                @if($selectedBidan->certification_document_url)
                                    <button wire:click="downloadDocument('certification')"
                                            class="text-blue-500 hover:text-blue-700 text-sm">
                                        📄 Download Sertifikat
                                    </button>
                                @else
                                    <span class="text-red-500 text-sm">Dokumen tidak tersedia</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- Verification Action --}}
                    @if($selectedBidan->verification_status === 'pending')
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Catatan Verifikasi</label>
                            <textarea wire:model="verificationNotes" 
                                      rows="3"
                                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                      placeholder="Berikan catatan untuk keputusan verifikasi (minimal 10 karakter)..."></textarea>
                            @error('verificationNotes') 
                                <span class="text-sm text-red-500">{{ $message }}</span> 
                            @enderror
                        </div>
                    @endif

                    {{-- Previous Notes --}}
                    @if($selectedBidan->verification_notes)
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Catatan Sebelumnya</label>
                            <p class="text-gray-900 bg-gray-50 p-3 rounded-lg">{{ $selectedBidan->verification_notes }}</p>
                            @if($selectedBidan->verified_at)
                                <p class="text-sm text-gray-500 mt-1">
                                    Diverifikasi: {{ $selectedBidan->verified_at->format('d M Y H:i') }}
                                </p>
                            @endif
                        </div>
                    @endif
                </div>

                {{-- Modal Actions --}}
                @if($selectedBidan->verification_status === 'pending')
                    <div class="flex justify-end space-x-3 mt-6 pt-6 border-t border-gray-200">
                        <button wire:click="closeModal"
                                class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                            Batal
                        </button>
                        <button wire:click="verifyBidan('reject')"
                                wire:loading.attr="disabled"
                                class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors disabled:opacity-50">
                            Tolak
                        </button>
                        <button wire:click="verifyBidan('approve')"
                                wire:loading.attr="disabled"
                                class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors disabled:opacity-50">
                            Setujui
                        </button>
                    </div>
                @else
                    <div class="flex justify-end mt-6 pt-6 border-t border-gray-200">
                        <button wire:click="closeModal"
                                class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                            Tutup
                        </button>
                    </div>
                @endif
            </div>
        </div>
    @endif
</div>
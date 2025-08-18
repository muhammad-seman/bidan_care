<div class="max-w-7xl mx-auto p-6">
    {{-- Header --}}
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Kelola Layanan</h1>
            <p class="text-gray-600">Atur dan kelola layanan yang Anda tawarkan</p>
        </div>
        <button wire:click="openCreateModal" 
                class="bg-gradient-to-r from-pink-500 to-rose-500 text-white px-6 py-3 rounded-lg font-semibold hover:from-pink-600 hover:to-rose-600 transition-colors shadow-lg">
            + Tambah Layanan
        </button>
    </div>

    {{-- Statistics Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="p-2 bg-blue-100 rounded-lg">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Layanan</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['total'] }}</p>
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
                    <p class="text-sm font-medium text-gray-600">Layanan Aktif</p>
                    <p class="text-2xl font-bold text-green-600">{{ $stats['active'] }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="p-2 bg-gray-100 rounded-lg">
                    <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Tidak Aktif</p>
                    <p class="text-2xl font-bold text-gray-600">{{ $stats['inactive'] }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="p-2 bg-yellow-100 rounded-lg">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Booking</p>
                    <p class="text-2xl font-bold text-yellow-600">{{ $stats['total_bookings'] }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Filters --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-8">
        <div class="flex flex-col md:flex-row gap-4">
            {{-- Search --}}
            <div class="flex-1">
                <input type="text" 
                       wire:model.live.debounce.300ms="search" 
                       placeholder="Cari layanan..."
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500">
            </div>

            {{-- Status Filter --}}
            <div class="md:w-48">
                <select wire:model.live="statusFilter" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500">
                    <option value="all">Semua Status</option>
                    <option value="active">Aktif</option>
                    <option value="inactive">Tidak Aktif</option>
                </select>
            </div>

            {{-- Category Filter --}}
            <div class="md:w-56">
                <select wire:model.live="categoryFilter" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500">
                    <option value="all">Semua Kategori</option>
                    @foreach($this->categories as $value => $label)
                        <option value="{{ $value }}">{{ $label }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    {{-- Services List --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        @if($services->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Layanan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori & Tipe</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga & Durasi</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Booking</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($services as $service)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">{{ $service->service_name }}</div>
                                        <div class="text-sm text-gray-500">{{ Str::limit($service->description, 80) }}</div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $this->categories[$service->category] ?? $service->category }}</div>
                                    <div class="text-sm text-gray-500">{{ $this->serviceTypes[$service->service_type] ?? $service->service_type }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">Rp {{ number_format($service->price, 0, ',', '.') }}</div>
                                    <div class="text-sm text-gray-500">{{ $service->duration_minutes }} menit</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($service->is_active)
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                            Aktif
                                        </span>
                                    @else
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">
                                            Tidak Aktif
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $service->total_bookings }} booking</div>
                                    @if($service->average_rating > 0)
                                        <div class="flex items-center text-sm text-yellow-500">
                                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                            {{ number_format($service->average_rating, 1) }}
                                        </div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-2">
                                        <button wire:click="openEditModal({{ $service->id }})"
                                                class="text-indigo-600 hover:text-indigo-900 transition-colors">
                                            Edit
                                        </button>
                                        <button wire:click="toggleServiceStatus({{ $service->id }})"
                                                class="{{ $service->is_active ? 'text-red-600 hover:text-red-900' : 'text-green-600 hover:text-green-900' }} transition-colors">
                                            {{ $service->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                                        </button>
                                        @if($service->total_bookings == 0)
                                            <button wire:click="deleteService({{ $service->id }})"
                                                    wire:confirm="Yakin ingin menghapus layanan ini?"
                                                    class="text-red-600 hover:text-red-900 transition-colors">
                                                Hapus
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $services->links() }}
            </div>
        @else
            <div class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada layanan</h3>
                <p class="mt-1 text-sm text-gray-500">Mulai dengan menambahkan layanan pertama Anda.</p>
                <div class="mt-6">
                    <button wire:click="openCreateModal" 
                            class="bg-gradient-to-r from-pink-500 to-rose-500 text-white px-4 py-2 rounded-lg font-medium hover:from-pink-600 hover:to-rose-600 transition-colors">
                        + Tambah Layanan
                    </button>
                </div>
            </div>
        @endif
    </div>

    {{-- Service Modal --}}
    @if($showModal)
        <div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50" 
             wire:click="closeModal">
            <div class="relative top-10 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white max-h-screen overflow-y-auto"
                 wire:click.stop>
                
                {{-- Modal Header --}}
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-bold text-gray-900">
                        {{ $isEditing ? 'Edit Layanan' : 'Tambah Layanan Baru' }}
                    </h3>
                    <button wire:click="closeModal" 
                            class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                {{-- Modal Content --}}
                <form wire:submit="saveService" class="space-y-6">
                    {{-- Basic Info --}}
                    <div class="grid md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Layanan *</label>
                            <input type="text" 
                                   wire:model="service_name" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500"
                                   placeholder="Contoh: Konsultasi Kehamilan">
                            @error('service_name') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Kategori *</label>
                            <select wire:model="category" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500">
                                @foreach($this->categories as $value => $label)
                                    <option value="{{ $value }}">{{ $label }}</option>
                                @endforeach
                            </select>
                            @error('category') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    {{-- Description --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Layanan *</label>
                        <textarea wire:model="description" 
                                  rows="4"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500"
                                  placeholder="Jelaskan layanan Anda secara detail (minimal 20 karakter)..."></textarea>
                        @error('description') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                    </div>

                    {{-- Price & Duration --}}
                    <div class="grid md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Harga (Rp) *</label>
                            <input type="number" 
                                   wire:model="price" 
                                   min="10000"
                                   max="5000000"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500"
                                   placeholder="150000">
                            @error('price') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Durasi (menit) *</label>
                            <input type="number" 
                                   wire:model="duration_minutes" 
                                   min="15"
                                   max="480"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500"
                                   placeholder="60">
                            @error('duration_minutes') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Tipe Layanan *</label>
                            <select wire:model="service_type" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500">
                                @foreach($this->serviceTypes as $value => $label)
                                    <option value="{{ $value }}">{{ $label }}</option>
                                @endforeach
                            </select>
                            @error('service_type') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    {{-- Additional Info --}}
                    <div class="grid md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Persyaratan Khusus</label>
                            <textarea wire:model="requirements" 
                                      rows="3"
                                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500"
                                      placeholder="Satu persyaratan per baris..."></textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Yang Termasuk dalam Layanan</label>
                            <textarea wire:model="included_services" 
                                      rows="3"
                                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500"
                                      placeholder="Satu item per baris..."></textarea>
                        </div>
                    </div>

                    {{-- Preparation Notes --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Catatan Persiapan</label>
                        <textarea wire:model="preparation_notes" 
                                  rows="2"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500"
                                  placeholder="Apa yang perlu disiapkan pasien sebelum sesi..."></textarea>
                    </div>

                    {{-- Booking Rules --}}
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h4 class="font-medium text-gray-900 mb-4">Aturan Booking</h4>
                        <div class="grid md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Min. Booking (jam sebelumnya)</label>
                                <input type="number" 
                                       wire:model="min_booking_hours" 
                                       min="1"
                                       max="168"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Max. Booking (hari ke depan)</label>
                                <input type="number" 
                                       wire:model="max_advance_days" 
                                       min="1"
                                       max="365"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Batas Pembatalan (jam sebelumnya)</label>
                                <input type="number" 
                                       wire:model="cancellation_hours" 
                                       min="1"
                                       max="168"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500">
                            </div>

                            <div class="flex flex-col space-y-2">
                                <label class="flex items-center">
                                    <input type="checkbox" 
                                           wire:model="allow_reschedule"
                                           class="rounded border-gray-300 text-pink-600 shadow-sm focus:border-pink-300 focus:ring focus:ring-pink-200 focus:ring-opacity-50">
                                    <span class="ml-2 text-sm text-gray-700">Izinkan reschedule</span>
                                </label>

                                <label class="flex items-center">
                                    <input type="checkbox" 
                                           wire:model="allow_cancellation"
                                           class="rounded border-gray-300 text-pink-600 shadow-sm focus:border-pink-300 focus:ring focus:ring-pink-200 focus:ring-opacity-50">
                                    <span class="ml-2 text-sm text-gray-700">Izinkan pembatalan</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    {{-- Modal Actions --}}
                    <div class="flex justify-end space-x-3 pt-6 border-t border-gray-200">
                        <button type="button"
                                wire:click="closeModal"
                                class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                            Batal
                        </button>
                        <button type="submit"
                                wire:loading.attr="disabled"
                                class="px-6 py-2 bg-gradient-to-r from-pink-500 to-rose-500 text-white rounded-lg hover:from-pink-600 hover:to-rose-600 transition-colors disabled:opacity-50">
                            <span wire:loading.remove>{{ $isEditing ? 'Update Layanan' : 'Simpan Layanan' }}</span>
                            <span wire:loading>Processing...</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
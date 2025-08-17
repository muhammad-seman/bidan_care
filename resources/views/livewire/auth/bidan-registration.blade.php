<div class="min-h-screen bg-gradient-to-br from-pink-50 via-white to-rose-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-2xl mx-auto">
        {{-- Header --}}
        <div class="text-center mb-8">
            <div class="mx-auto h-16 w-16 bg-gradient-to-r from-pink-500 to-rose-500 rounded-2xl flex items-center justify-center mb-4">
                <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <h2 class="text-3xl font-bold text-gray-900 mb-2">Daftar Sebagai Bidan</h2>
            <p class="text-gray-600">Bergabunglah dengan platform HomeCare dan mulai melayani pasien</p>
        </div>

        {{-- Progress Bar --}}
        <div class="mb-8">
            <div class="flex items-center justify-between text-sm font-medium text-gray-500 mb-2">
                <span>Langkah {{ $currentStep }} dari {{ $totalSteps }}</span>
                <span>{{ $this->stepProgress }}%</span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-3">
                <div class="bg-gradient-to-r from-pink-500 to-rose-500 h-3 rounded-full transition-all duration-300"
                     style="width: {{ $this->stepProgress }}%"></div>
            </div>
        </div>

        {{-- Form Container --}}
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <form wire:submit="submit">
                {{-- Step 1: Account Information --}}
                @if($currentStep === 1)
                    <div class="p-8">
                        <div class="mb-6">
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">Informasi Akun</h3>
                            <p class="text-gray-600">Masukkan data dasar untuk akun Anda</p>
                        </div>

                        <div class="space-y-6">
                            {{-- Name --}}
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                                <input type="text" 
                                       wire:model="name" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500"
                                       placeholder="Masukkan nama lengkap Anda">
                                @error('name') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                            </div>

                            {{-- Email --}}
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                <input type="email" 
                                       wire:model="email" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500"
                                       placeholder="masukkan@email.com">
                                @error('email') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                            </div>

                            {{-- Phone --}}
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Nomor Telepon</label>
                                <input type="text" 
                                       wire:model="phone" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500"
                                       placeholder="08123456789">
                                @error('phone') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                            </div>

                            {{-- Password --}}
                            <div class="grid md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                                    <input type="password" 
                                           wire:model="password" 
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500"
                                           placeholder="Minimal 8 karakter">
                                    @error('password') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Password</label>
                                    <input type="password" 
                                           wire:model="password_confirmation" 
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500"
                                           placeholder="Ulangi password">
                                    @error('password_confirmation') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Step 2: Professional Information --}}
                @if($currentStep === 2)
                    <div class="p-8">
                        <div class="mb-6">
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">Informasi Profesional</h3>
                            <p class="text-gray-600">Data profesional dan keahlian Anda</p>
                        </div>

                        <div class="space-y-6">
                            {{-- License Number --}}
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Nomor STR (Surat Tanda Registrasi)</label>
                                <input type="text" 
                                       wire:model="license_number" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500"
                                       placeholder="Nomor STR Anda">
                                @error('license_number') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                            </div>

                            {{-- Specialization & Experience --}}
                            <div class="grid md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Spesialisasi</label>
                                    <select wire:model="specialization" 
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500">
                                        <option value="">Pilih Spesialisasi</option>
                                        <option value="Bidan Umum">Bidan Umum</option>
                                        <option value="Bidan Komunitas">Bidan Komunitas</option>
                                        <option value="Bidan Klinik">Bidan Klinik</option>
                                        <option value="Bidan Pendidik">Bidan Pendidik</option>
                                        <option value="Bidan Manajemen">Bidan Manajemen</option>
                                    </select>
                                    @error('specialization') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Pengalaman (Tahun)</label>
                                    <input type="number" 
                                           wire:model="experience_years" 
                                           min="1" 
                                           max="50"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500"
                                           placeholder="5">
                                    @error('experience_years') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            {{-- Bio --}}
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Bio & Deskripsi Diri</label>
                                <textarea wire:model="bio" 
                                          rows="4"
                                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500"
                                          placeholder="Ceritakan tentang pengalaman, keahlian, dan pendekatan Anda dalam melayani pasien... (minimal 50 karakter)"></textarea>
                                @error('bio') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                                <p class="text-sm text-gray-500 mt-1">{{ strlen($bio) }} karakter (minimal 50)</p>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Step 3: Location Information --}}
                @if($currentStep === 3)
                    <div class="p-8">
                        <div class="mb-6">
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">Informasi Lokasi</h3>
                            <p class="text-gray-600">Lokasi praktik dan area layanan Anda</p>
                        </div>

                        <div class="space-y-6">
                            {{-- Detailed Address --}}
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Alamat Detail</label>
                                <textarea wire:model="detailed_address" 
                                          rows="3"
                                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500"
                                          placeholder="Jalan, nomor rumah, RT/RW, nama gedung atau patokan..."></textarea>
                                @error('detailed_address') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                            </div>

                            {{-- Wilayah Dropdown --}}
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Wilayah</label>
                                <livewire:components.wilayah-dropdown 
                                    :show-province="true"
                                    :show-regency="true"
                                    :show-district="true"
                                    :show-village="true"
                                    container-class="grid grid-cols-1 md:grid-cols-2 gap-4"
                                />
                                @error('selectedProvince') <span class="text-sm text-red-500">Provinsi harus dipilih</span> @enderror
                                @error('selectedRegency') <span class="text-sm text-red-500">Kabupaten/Kota harus dipilih</span> @enderror
                                @error('selectedDistrict') <span class="text-sm text-red-500">Kecamatan harus dipilih</span> @enderror
                                @error('selectedVillage') <span class="text-sm text-red-500">Kelurahan/Desa harus dipilih</span> @enderror
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Step 4: Document Upload --}}
                @if($currentStep === 4)
                    <div class="p-8">
                        <div class="mb-6">
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">Upload Dokumen</h3>
                            <p class="text-gray-600">Upload dokumen untuk proses verifikasi</p>
                        </div>

                        <div class="space-y-6">
                            {{-- License Document --}}
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Dokumen STR <span class="text-red-500">*</span>
                                </label>
                                <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 hover:border-pink-400 transition-colors">
                                    <input type="file" 
                                           wire:model="license_document" 
                                           accept=".pdf,.jpg,.jpeg,.png"
                                           class="w-full">
                                    <p class="text-sm text-gray-500 mt-2">Format: PDF, JPG, JPEG, PNG (Max: 2MB)</p>
                                </div>
                                @error('license_document') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                                <div wire:loading wire:target="license_document" class="text-sm text-blue-500">Uploading...</div>
                            </div>

                            {{-- Certification Document --}}
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Sertifikat Kompetensi <span class="text-red-500">*</span>
                                </label>
                                <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 hover:border-pink-400 transition-colors">
                                    <input type="file" 
                                           wire:model="certification_document" 
                                           accept=".pdf,.jpg,.jpeg,.png"
                                           class="w-full">
                                    <p class="text-sm text-gray-500 mt-2">Format: PDF, JPG, JPEG, PNG (Max: 2MB)</p>
                                </div>
                                @error('certification_document') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                                <div wire:loading wire:target="certification_document" class="text-sm text-blue-500">Uploading...</div>
                            </div>

                            {{-- Profile Photo --}}
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Foto Profil <span class="text-gray-400">(Opsional)</span>
                                </label>
                                <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 hover:border-pink-400 transition-colors">
                                    <input type="file" 
                                           wire:model="profile_photo" 
                                           accept=".jpg,.jpeg,.png"
                                           class="w-full">
                                    <p class="text-sm text-gray-500 mt-2">Format: JPG, JPEG, PNG (Max: 1MB)</p>
                                </div>
                                @error('profile_photo') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                                <div wire:loading wire:target="profile_photo" class="text-sm text-blue-500">Uploading...</div>
                            </div>

                            {{-- Preview uploaded files --}}
                            <div class="grid md:grid-cols-3 gap-4">
                                @if($license_document)
                                    <div class="bg-green-50 p-3 rounded-lg border border-green-200">
                                        <p class="text-sm font-medium text-green-800">✓ STR</p>
                                        <p class="text-xs text-green-600">{{ $license_document->getClientOriginalName() }}</p>
                                    </div>
                                @endif

                                @if($certification_document)
                                    <div class="bg-green-50 p-3 rounded-lg border border-green-200">
                                        <p class="text-sm font-medium text-green-800">✓ Sertifikat</p>
                                        <p class="text-xs text-green-600">{{ $certification_document->getClientOriginalName() }}</p>
                                    </div>
                                @endif

                                @if($profile_photo)
                                    <div class="bg-green-50 p-3 rounded-lg border border-green-200">
                                        <p class="text-sm font-medium text-green-800">✓ Foto Profil</p>
                                        <p class="text-xs text-green-600">{{ $profile_photo->getClientOriginalName() }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Navigation Buttons --}}
                <div class="bg-gray-50 px-8 py-6 border-t border-gray-200">
                    <div class="flex justify-between">
                        {{-- Previous Button --}}
                        @if($currentStep > 1)
                            <button type="button" 
                                    wire:click="previousStep"
                                    class="px-6 py-3 border border-gray-300 rounded-lg text-gray-700 font-medium hover:bg-gray-50 transition-colors">
                                ← Sebelumnya
                            </button>
                        @else
                            <div></div>
                        @endif

                        {{-- Next/Submit Button --}}
                        @if($currentStep < $totalSteps)
                            <button type="button" 
                                    wire:click="nextStep"
                                    class="px-6 py-3 bg-gradient-to-r from-pink-500 to-rose-500 text-white font-medium rounded-lg hover:from-pink-600 hover:to-rose-600 transition-colors">
                                Selanjutnya →
                            </button>
                        @else
                            <button type="submit" 
                                    wire:loading.attr="disabled"
                                    wire:target="submit"
                                    class="px-8 py-3 bg-gradient-to-r from-pink-500 to-rose-500 text-white font-medium rounded-lg hover:from-pink-600 hover:to-rose-600 transition-colors disabled:opacity-50">
                                <span wire:loading.remove wire:target="submit">Daftar Sekarang</span>
                                <span wire:loading wire:target="submit">Processing...</span>
                            </button>
                        @endif
                    </div>
                </div>
            </form>
        </div>

        {{-- Login Link --}}
        <div class="text-center mt-8">
            <p class="text-gray-600">
                Sudah punya akun? 
                <a href="{{ route('login') }}" class="text-pink-500 font-medium hover:text-pink-600">Masuk di sini</a>
            </p>
        </div>
    </div>
</div>
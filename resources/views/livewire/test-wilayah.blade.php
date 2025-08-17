<div class="max-w-4xl mx-auto p-6">
    <div class="bg-white rounded-xl shadow-lg p-8">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">🌍 Test Wilayah Indonesia API</h1>
            <p class="text-gray-600">Cascading dropdown untuk wilayah Indonesia menggunakan API custom yang telah di-deploy.</p>
        </div>

        {{-- API Status Check --}}
        <div class="mb-8 p-4 bg-blue-50 rounded-lg border border-blue-200">
            <div class="flex items-center space-x-2">
                <div class="w-3 h-3 bg-green-500 rounded-full animate-pulse"></div>
                <span class="text-sm font-medium text-blue-800">API Status: Active</span>
                <span class="text-xs text-blue-600">(muhammad-seman.github.io/api-wilayah-indonesia)</span>
            </div>
        </div>

        {{-- Wilayah Dropdown Component --}}
        <div class="mb-8">
            <h2 class="text-xl font-semibold text-gray-900 mb-4">Pilih Wilayah</h2>
            <livewire:components.wilayah-dropdown />
        </div>

        {{-- Selected Data Display --}}
        @if(!empty($selectedData))
            <div class="grid md:grid-cols-2 gap-6">
                {{-- Raw Data --}}
                <div class="bg-gray-50 p-6 rounded-lg">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Selected Data (Raw)</h3>
                    <div class="space-y-2 text-sm">
                        <div><span class="font-medium">Province ID:</span> {{ $selectedData['province'] ?? '-' }}</div>
                        <div><span class="font-medium">Regency ID:</span> {{ $selectedData['regency'] ?? '-' }}</div>
                        <div><span class="font-medium">District ID:</span> {{ $selectedData['district'] ?? '-' }}</div>
                        <div><span class="font-medium">Village ID:</span> {{ $selectedData['village'] ?? '-' }}</div>
                    </div>
                </div>

                {{-- Full Address --}}
                <div class="bg-green-50 p-6 rounded-lg">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Full Address</h3>
                    @if($fullAddress)
                        <p class="text-gray-800 leading-relaxed">{{ $fullAddress }}</p>
                    @else
                        <p class="text-gray-500 italic">Pilih semua wilayah untuk melihat alamat lengkap</p>
                    @endif
                </div>
            </div>
        @endif

        {{-- Usage Example --}}
        <div class="mt-8 p-6 bg-gray-900 text-white rounded-lg">
            <h3 class="text-lg font-semibold mb-4">💻 Usage Example</h3>
            <pre class="text-sm overflow-x-auto"><code>&lt;livewire:components.wilayah-dropdown 
    :show-province="true"
    :show-regency="true" 
    :show-district="true"
    :show-village="true"
    province-label="Provinsi"
    regency-label="Kabupaten/Kota"
    container-class="grid grid-cols-1 md:grid-cols-2 gap-4"
/&gt;</code></pre>
        </div>

        {{-- Features List --}}
        <div class="mt-8 grid md:grid-cols-3 gap-4">
            <div class="bg-pink-50 p-4 rounded-lg border border-pink-200">
                <h4 class="font-semibold text-pink-800 mb-2">🚀 Features</h4>
                <ul class="text-sm text-pink-700 space-y-1">
                    <li>• Cascading dropdowns</li>
                    <li>• Real-time loading</li>
                    <li>• Customizable labels</li>
                    <li>• Event dispatch</li>
                </ul>
            </div>

            <div class="bg-blue-50 p-4 rounded-lg border border-blue-200">
                <h4 class="font-semibold text-blue-800 mb-2">⚡ Performance</h4>
                <ul class="text-sm text-blue-700 space-y-1">
                    <li>• Redis cache (24h TTL)</li>
                    <li>• Fallback API</li>
                    <li>• Error handling</li>
                    <li>• Timeout protection</li>
                </ul>
            </div>

            <div class="bg-green-50 p-4 rounded-lg border border-green-200">
                <h4 class="font-semibold text-green-800 mb-2">🎯 Use Cases</h4>
                <ul class="text-sm text-green-700 space-y-1">
                    <li>• Bidan registration</li>
                    <li>• Patient profile</li>
                    <li>• Booking location</li>
                    <li>• Service area</li>
                </ul>
            </div>
        </div>
    </div>
</div>

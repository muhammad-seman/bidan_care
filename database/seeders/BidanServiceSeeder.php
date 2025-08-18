<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BidanService;
use App\Models\BidanProfile;

class BidanServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get verified bidan profiles
        $verifiedBidanProfiles = BidanProfile::where('verification_status', 'verified')
                                            ->where('is_active', true)
                                            ->get();

        // Define common services offered by bidan
        $serviceTemplates = [
            [
                'name' => 'Konsultasi Kehamilan',
                'description' => 'Pemeriksaan rutin kehamilan, monitoring kesehatan ibu dan janin, konsultasi nutrisi dan gaya hidup selama kehamilan.',
                'price' => 150000,
                'duration_minutes' => 60,
                'service_type' => 'konsultasi',
                'location_type' => 'both',
            ],
            [
                'name' => 'Pemeriksaan Antenatal Care (ANC)',
                'description' => 'Pemeriksaan lengkap kehamilan termasuk pengukuran tinggi fundus, denyut jantung janin, tekanan darah, dan berat badan.',
                'price' => 200000,
                'duration_minutes' => 90,
                'service_type' => 'pemeriksaan',
                'location_type' => 'both',
            ],
            [
                'name' => 'Kelas Ibu Hamil',
                'description' => 'Edukasi komprehensif tentang kehamilan, persiapan persalinan, teknik pernapasan, dan perawatan bayi.',
                'price' => 300000,
                'duration_minutes' => 120,
                'service_type' => 'edukasi',
                'location_type' => 'klinik',
            ],
            [
                'name' => 'Perawatan Nifas',
                'description' => 'Perawatan pasca melahirkan, monitoring involusi uteri, konseling ASI eksklusif, dan deteksi dini komplikasi.',
                'price' => 175000,
                'duration_minutes' => 75,
                'service_type' => 'perawatan',
                'location_type' => 'both',
            ],
            [
                'name' => 'Pijat Bayi & Stimulasi',
                'description' => 'Pijat bayi untuk meningkatkan bonding, stimulasi perkembangan motorik, dan teknik menenangkan bayi.',
                'price' => 125000,
                'duration_minutes' => 45,
                'service_type' => 'terapi',
                'location_type' => 'both',
            ],
            [
                'name' => 'Konseling Laktasi',
                'description' => 'Konsultasi menyusui, troubleshooting masalah ASI, teknik menyusui yang benar, dan manajemen laktasi.',
                'price' => 100000,
                'duration_minutes' => 60,
                'service_type' => 'konsultasi',
                'location_type' => 'both',
            ],
            [
                'name' => 'Senam Hamil',
                'description' => 'Senam khusus ibu hamil untuk menjaga kebugaran, persiapan persalinan, dan mengurangi keluhan kehamilan.',
                'price' => 80000,
                'duration_minutes' => 60,
                'service_type' => 'terapi',
                'location_type' => 'klinik',
            ],
            [
                'name' => 'Konsultasi KB & Reproduksi',
                'description' => 'Konsultasi metode kontrasepsi, perencanaan kehamilan, dan kesehatan reproduksi wanita.',
                'price' => 120000,
                'duration_minutes' => 45,
                'service_type' => 'konsultasi',
                'location_type' => 'both',
            ],
            [
                'name' => 'Pendampingan Persalinan',
                'description' => 'Pendampingan persalinan normal, bantuan teknik pernapasan, dan dukungan emosional selama proses persalinan.',
                'price' => 500000,
                'duration_minutes' => 360,
                'service_type' => 'persalinan',
                'location_type' => 'klinik',
            ],
            [
                'name' => 'Prenatal Yoga',
                'description' => 'Yoga khusus ibu hamil untuk relaksasi, memperkuat otot panggul, dan persiapan mental persalinan.',
                'price' => 100000,
                'duration_minutes' => 75,
                'service_type' => 'terapi',
                'location_type' => 'klinik',
            ],
            [
                'name' => 'Home Visit Postnatal',
                'description' => 'Kunjungan rumah pasca melahirkan untuk monitoring kondisi ibu dan bayi, perawatan tali pusat, dan konseling.',
                'price' => 250000,
                'duration_minutes' => 90,
                'service_type' => 'perawatan',
                'location_type' => 'rumah',
            ],
            [
                'name' => 'Deteksi Dini Komplikasi Kehamilan',
                'description' => 'Screening dan deteksi dini berbagai komplikasi kehamilan seperti preeklampsia, diabetes gestasional, dll.',
                'price' => 180000,
                'duration_minutes' => 60,
                'service_type' => 'pemeriksaan',
                'location_type' => 'klinik',
            ],
        ];

        // Assign services to each verified bidan
        foreach ($verifiedBidanProfiles as $index => $bidanProfile) {
            // Each bidan gets 4-8 services randomly
            $numberOfServices = rand(4, 8);
            $selectedServices = collect($serviceTemplates)->random($numberOfServices);

            foreach ($selectedServices as $service) {
                // Add some variation to price based on bidan experience
                $priceVariation = rand(-20, 30); // -20% to +30%
                $adjustedPrice = $service['price'] + ($service['price'] * $priceVariation / 100);
                $adjustedPrice = round($adjustedPrice / 5000) * 5000; // Round to nearest 5000

                // Map service types for migration compatibility
                $serviceTypeMapping = [
                    'konsultasi' => 'clinic',
                    'pemeriksaan' => 'clinic', 
                    'edukasi' => 'clinic',
                    'perawatan' => 'home_visit',
                    'terapi' => 'clinic',
                    'persalinan' => 'clinic',
                ];
                
                // Map categories for migration compatibility
                $categoryMapping = [
                    'konsultasi' => 'konsultasi_kehamilan',
                    'pemeriksaan' => 'pemeriksaan_rutin',
                    'edukasi' => 'konsultasi_umum',
                    'perawatan' => 'perawatan_pasca_melahirkan',
                    'terapi' => 'prenatal_care',
                    'persalinan' => 'prenatal_care',
                ];
                
                $mappedServiceType = $serviceTypeMapping[$service['service_type']] ?? 'clinic';
                $mappedCategory = $categoryMapping[$service['service_type']] ?? 'konsultasi_umum';

                BidanService::create([
                    'bidan_id' => $bidanProfile->id,
                    'service_name' => $service['name'],
                    'description' => $service['description'],
                    'price' => $adjustedPrice,
                    'duration_minutes' => $service['duration_minutes'],
                    'service_type' => $mappedServiceType,
                    'category' => $mappedCategory,
                    'is_active' => true,
                ]);
            }
        }

        // Add some specialized services for specific bidan
        $specializedServices = [
            [
                'bidan_id' => 1, // Bidan Sari - experienced general
                'service_name' => 'Hypnobirthing Class',
                'description' => 'Kelas hypnobirthing untuk persalinan yang tenang dan natural menggunakan teknik relaksasi mendalam.',
                'price' => 400000,
                'duration_minutes' => 180,
                'service_type' => 'clinic',
                'category' => 'prenatal_care',
                'is_active' => true,
            ],
            [
                'bidan_id' => 3, // Bidan Dewi - experienced clinic
                'service_name' => 'USG Obstetri 4D',
                'description' => 'Pemeriksaan USG obstetri 4 dimensi untuk monitoring detail perkembangan janin dan deteksi kelainan.',
                'price' => 350000,
                'duration_minutes' => 45,
                'service_type' => 'clinic',
                'category' => 'pemeriksaan_rutin',
                'is_active' => true,
            ],
            [
                'bidan_id' => 6, // Bidan Ayu - community focused
                'service_name' => 'Posyandu Keliling',
                'description' => 'Pelayanan posyandu mobile ke wilayah terpencil untuk pemeriksaan ibu hamil dan balita.',
                'price' => 150000,
                'duration_minutes' => 120,
                'service_type' => 'home_visit',
                'category' => 'pemeriksaan_rutin',
                'is_active' => true,
            ],
            [
                'bidan_id' => 8, // Bidan Nina - clinic experienced
                'service_name' => 'Konsultasi High Risk Pregnancy',
                'description' => 'Konsultasi khusus untuk kehamilan berisiko tinggi dengan monitoring intensif dan rujukan yang tepat.',
                'price' => 300000,
                'duration_minutes' => 90,
                'service_type' => 'clinic',
                'category' => 'konsultasi_kehamilan',
                'is_active' => true,
            ],
        ];

        // Create specialized services
        foreach ($specializedServices as $service) {
            $bidanProfile = BidanProfile::find($service['bidan_id']);
            if ($bidanProfile && $bidanProfile->verification_status === 'verified') {
                BidanService::create($service);
            }
        }
    }
}
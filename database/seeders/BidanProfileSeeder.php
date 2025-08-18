<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BidanProfile;
use App\Models\User;

class BidanProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all bidan users
        $bidanUsers = User::where('role', 'bidan')->get();

        // Define bidan profile data with realistic Indonesian locations
        $bidanProfiles = [
            [
                'license_number' => 'STR-BD-2023-001',
                'specialization' => 'Bidan Umum',
                'experience_years' => 8,
                'bio' => 'Berpengalaman dalam pendampingan kehamilan, persalinan normal, dan perawatan nifas. Menguasai teknik prenatal yoga dan pijat bayi. Aktif memberikan edukasi kesehatan reproduksi kepada ibu-ibu di komunitas.',
                'detailed_address' => 'Jl. Merdeka No. 45, RT 02 RW 05, Perumahan Griya Asri',
                'province_id' => '31', // DKI Jakarta
                'regency_id' => '3171', // Jakarta Selatan
                'district_id' => '3171020', // Kebayoran Baru
                'village_id' => '3171020005', // Melawai
                'verification_status' => 'verified',
                'verified_at' => now()->subDays(15),
                'verified_by' => 1, // Admin ID
                'verification_notes' => 'Semua dokumen lengkap dan valid. STR masih berlaku. Bidan berpengalaman dengan rekam jejak yang baik.',
                'is_active' => true,
                'license_document_url' => 'bidan-documents/licenses/str-sari.pdf',
                'certification_document_url' => 'bidan-documents/certifications/cert-sari.pdf',
                'profile_photo_url' => 'bidan-photos/profiles/sari.jpg',
            ],
            [
                'license_number' => 'STR-BD-2023-002',
                'specialization' => 'Bidan Komunitas',
                'experience_years' => 5,
                'bio' => 'Fokus pada pelayanan kesehatan ibu dan anak di tingkat komunitas. Berpengalaman dalam program KB, posyandu, dan kelas ibu hamil. Memiliki sertifikat konseling laktasi.',
                'detailed_address' => 'Jl. Raya Bogor KM 25, Komplek Villa Hijau Blok B12',
                'province_id' => '32', // Jawa Barat
                'regency_id' => '3276', // Depok
                'district_id' => '3276020', // Pancoran Mas
                'village_id' => '3276020001', // Pancoran Mas
                'verification_status' => 'pending',
                'verified_at' => null,
                'verified_by' => null,
                'verification_notes' => null,
                'is_active' => false,
                'license_document_url' => 'bidan-documents/licenses/str-maya.pdf',
                'certification_document_url' => 'bidan-documents/certifications/cert-maya.pdf',
                'profile_photo_url' => 'bidan-photos/profiles/maya.jpg',
            ],
            [
                'license_number' => 'STR-BD-2023-003',
                'specialization' => 'Bidan Klinik',
                'experience_years' => 12,
                'bio' => 'Bidan senior dengan spesialisasi penanganan kehamilan risiko tinggi. Berpengalaman di rumah sakit dan klinik bersalin. Menguasai CTG dan USG obstetri dasar.',
                'detailed_address' => 'Jl. Diponegoro No. 125, RT 08 RW 03, Perumahan Permata Hijau',
                'province_id' => '33', // Jawa Tengah
                'regency_id' => '3374', // Semarang
                'district_id' => '3374090', // Tembalang
                'village_id' => '3374090001', // Tembalang
                'verification_status' => 'verified',
                'verified_at' => now()->subDays(8),
                'verified_by' => 1,
                'verification_notes' => 'Profil sangat baik. Pengalaman klinis yang mumpuni dan sertifikat up-to-date.',
                'is_active' => true,
                'license_document_url' => 'bidan-documents/licenses/str-dewi.pdf',
                'certification_document_url' => 'bidan-documents/certifications/cert-dewi.pdf',
                'profile_photo_url' => 'bidan-photos/profiles/dewi.jpg',
            ],
            [
                'license_number' => 'STR-BD-2022-078',
                'specialization' => 'Bidan Umum',
                'experience_years' => 3,
                'bio' => 'Bidan muda yang energik dan up-to-date dengan teknologi kesehatan terkini. Lulusan Politeknik Kesehatan dengan IPK cumlaude. Aktif mengikuti seminar dan workshop.',
                'detailed_address' => 'Jl. Ahmad Yani No. 88, Komplek Graha Residence No. 15',
                'province_id' => '34', // D.I. Yogyakarta
                'regency_id' => '3471', // Yogyakarta
                'district_id' => '3471020', // Gondokusuman
                'village_id' => '3471020001', // Baciro
                'verification_status' => 'rejected',
                'verified_at' => null,
                'verified_by' => 1,
                'verification_notes' => 'STR belum diperpanjang. Silakan upload STR yang masih berlaku dan ajukan kembali permohonan verifikasi.',
                'is_active' => false,
                'license_document_url' => 'bidan-documents/licenses/str-rani.pdf',
                'certification_document_url' => 'bidan-documents/certifications/cert-rani.pdf',
                'profile_photo_url' => 'bidan-photos/profiles/rani.jpg',
            ],
            [
                'license_number' => 'STR-BD-2023-015',
                'specialization' => 'Bidan Pendidik',
                'experience_years' => 15,
                'bio' => 'Bidan senior dengan latar belakang pendidikan. Berpengalaman sebagai instruktur di akademi kebidanan. Aktif dalam penelitian dan publikasi ilmiah di bidang kebidanan.',
                'detailed_address' => 'Jl. Prof. Dr. Satrio Kav. 3-5, Apartemen Casablanca Tower B Lt. 15',
                'province_id' => '31', // DKI Jakarta
                'regency_id' => '3175', // Jakarta Timur
                'district_id' => '3175050', // Tebet
                'village_id' => '3175050005', // Tebet Timur
                'verification_status' => 'pending',
                'verified_at' => null,
                'verified_by' => null,
                'verification_notes' => null,
                'is_active' => false,
                'license_document_url' => 'bidan-documents/licenses/str-lila.pdf',
                'certification_document_url' => 'bidan-documents/certifications/cert-lila.pdf',
                'profile_photo_url' => 'bidan-photos/profiles/lila.jpg',
            ],
            [
                'license_number' => 'STR-BD-2023-025',
                'specialization' => 'Bidan Komunitas',
                'experience_years' => 6,
                'bio' => 'Passionate dalam memberikan pelayanan kesehatan ibu dan anak di daerah urban. Memiliki pengalaman home visit dan mobile clinic. Komunikatif dan sabar dalam mendampingi pasien.',
                'detailed_address' => 'Jl. Sunset Road No. 99X, Gang Mawar III No. 5',
                'province_id' => '51', // Bali
                'regency_id' => '5171', // Denpasar
                'district_id' => '5171020', // Denpasar Selatan
                'village_id' => '5171020001', // Sesetan
                'verification_status' => 'verified',
                'verified_at' => now()->subDays(3),
                'verified_by' => 2,
                'verification_notes' => 'Dokumentasi lengkap dan valid. Portfolio pelayanan komunitas sangat mengesankan.',
                'is_active' => true,
                'license_document_url' => 'bidan-documents/licenses/str-ayu.pdf',
                'certification_document_url' => 'bidan-documents/certifications/cert-ayu.pdf',
                'profile_photo_url' => 'bidan-photos/profiles/ayu.jpg',
            ],
            [
                'license_number' => 'STR-BD-2023-030',
                'specialization' => 'Bidan Umum',
                'experience_years' => 7,
                'bio' => 'Bidan dengan pengalaman komprehensif dalam asuhan kebidanan. Terampil dalam penanganan persalinan normal dan komplikasi ringan. Memiliki sertifikat BLS dan PONED.',
                'detailed_address' => 'Jl. Pahlawan No. 156, RT 12 RW 04, Komplek Permata Indah',
                'province_id' => '35', // Jawa Timur
                'regency_id' => '3578', // Surabaya
                'district_id' => '3578140', // Gubeng
                'village_id' => '3578140001', // Airlangga
                'verification_status' => 'pending',
                'verified_at' => null,
                'verified_by' => null,
                'verification_notes' => null,
                'is_active' => false,
                'license_document_url' => 'bidan-documents/licenses/str-fitri.pdf',
                'certification_document_url' => 'bidan-documents/certifications/cert-fitri.pdf',
                'profile_photo_url' => null,
            ],
            [
                'license_number' => 'STR-BD-2023-040',
                'specialization' => 'Bidan Klinik',
                'experience_years' => 9,
                'bio' => 'Bidan yang berpengalaman dalam pelayanan klinik dan rumah sakit. Menguasai teknologi medis terkini dan memiliki kemampuan komunikasi yang baik dengan pasien dari berbagai latar belakang.',
                'detailed_address' => 'Jl. Gatot Subroto No. 201, Tower Hijau Lt. 8 Unit 805',
                'province_id' => '36', // Banten
                'regency_id' => '3671', // Tangerang
                'district_id' => '3671020', // Benda
                'village_id' => '3671020001', // Benda
                'verification_status' => 'verified',
                'verified_at' => now()->subDays(20),
                'verified_by' => 1,
                'verification_notes' => 'Semua persyaratan terpenuhi dengan baik. Riwayat pelayanan klinis sangat memuaskan.',
                'is_active' => true,
                'license_document_url' => 'bidan-documents/licenses/str-nina.pdf',
                'certification_document_url' => 'bidan-documents/certifications/cert-nina.pdf',
                'profile_photo_url' => 'bidan-photos/profiles/nina.jpg',
            ],
        ];

        // Create bidan profiles
        foreach ($bidanProfiles as $index => $profileData) {
            if (isset($bidanUsers[$index])) {
                BidanProfile::create([
                    'user_id' => $bidanUsers[$index]->id,
                    ...$profileData
                ]);
            }
        }
    }
}
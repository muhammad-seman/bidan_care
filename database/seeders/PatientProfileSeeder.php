<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PatientProfile;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;

class PatientProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all patient users
        $patientUsers = User::where('role', 'pasien')->get();

        // Define patient profile data with encrypted medical information
        $patientProfiles = [
            [
                'birth_date' => '1992-05-15',
                'address' => 'Jl. Mawar Indah No. 23, RT 05 RW 02, Perumahan Citra Garden',
                'province_id' => '31', // DKI Jakarta
                'regency_id' => '3171', // Jakarta Selatan
                'district_id' => '3171050', // Cilandak
                'village_id' => '3171050001', // Cilandak Barat
                'emergency_contact_name' => 'Budi Santoso (Suami)',
                'emergency_contact_phone' => '+6281234567810',
                'emergency_contact_relation' => 'Suami',
                'blood_type' => 'A+',
                'allergies' => Crypt::encryptString('Alergi seafood, penisilin'),
                'medical_history' => Crypt::encryptString('Riwayat hipertensi ringan saat kehamilan pertama. Persalinan normal tahun 2020.'),
                'current_medications' => Crypt::encryptString('Vitamin prenatal, asam folat'),
                'insurance_number' => 'BPJS-12345678901',
                'insurance_provider' => 'BPJS Kesehatan',
            ],
            [
                'birth_date' => '1988-11-22',
                'address' => 'Jl. Veteran No. 67, Komplek Permata Hijau Blok C15',
                'province_id' => '32', // Jawa Barat
                'regency_id' => '3204', // Bandung
                'district_id' => '3204110', // Coblong
                'village_id' => '3204110001', // Cipaganti
                'emergency_contact_name' => 'Siti Nurhaliza (Ibu)',
                'emergency_contact_phone' => '+6281234567811',
                'emergency_contact_relation' => 'Ibu',
                'blood_type' => 'O+',
                'allergies' => Crypt::encryptString('Tidak ada alergi yang diketahui'),
                'medical_history' => Crypt::encryptString('Persalinan caesar tahun 2018. Riwayat anemia ringan.'),
                'current_medications' => Crypt::encryptString('Suplemen zat besi, vitamin D'),
                'insurance_number' => 'BPJS-23456789012',
                'insurance_provider' => 'BPJS Kesehatan',
            ],
            [
                'birth_date' => '1995-03-08',
                'address' => 'Jl. Sudirman Kav. 45, Apartemen Sky Garden Tower 2 Lt. 12',
                'province_id' => '31', // DKI Jakarta
                'regency_id' => '3172', // Jakarta Pusat
                'district_id' => '3172020', // Tanah Abang
                'village_id' => '3172020001', // Gelora
                'emergency_contact_name' => 'Ahmad Rizki (Suami)',
                'emergency_contact_phone' => '+6281234567812',
                'emergency_contact_relation' => 'Suami',
                'blood_type' => 'B+',
                'allergies' => Crypt::encryptString('Alergi debu, bulu kucing'),
                'medical_history' => Crypt::encryptString('Kehamilan pertama. Tidak ada riwayat penyakit serius.'),
                'current_medications' => Crypt::encryptString('Vitamin prenatal'),
                'insurance_number' => 'SWASTA-34567890123',
                'insurance_provider' => 'Prudential',
            ],
            [
                'birth_date' => '1990-07-19',
                'address' => 'Jl. Gajah Mada No. 156, RT 08 RW 04, Kelurahan Petojo Utara',
                'province_id' => '33', // Jawa Tengah
                'regency_id' => '3372', // Kudus
                'district_id' => '3372010', // Kudus
                'village_id' => '3372010001', // Kajeksan
                'emergency_contact_name' => 'Dewi Lestari (Kakak)',
                'emergency_contact_phone' => '+6281234567813',
                'emergency_contact_relation' => 'Kakak',
                'blood_type' => 'AB+',
                'allergies' => Crypt::encryptString('Alergi obat anti-inflamasi'),
                'medical_history' => Crypt::encryptString('Diabetes gestasional pada kehamilan sebelumnya. Persalinan normal 2019.'),
                'current_medications' => Crypt::encryptString('Metformin, vitamin prenatal'),
                'insurance_number' => 'BPJS-45678901234',
                'insurance_provider' => 'BPJS Kesehatan',
            ],
            [
                'birth_date' => '1993-12-03',
                'address' => 'Jl. Malioboro No. 88, Komplek Jogja Heritage Residence',
                'province_id' => '34', // D.I. Yogyakarta
                'regency_id' => '3471', // Yogyakarta
                'district_id' => '3471010', // Mergangsan
                'village_id' => '3471010001', // Keparakan
                'emergency_contact_name' => 'Bambang Sutrisno (Suami)',
                'emergency_contact_phone' => '+6281234567814',
                'emergency_contact_relation' => 'Suami',
                'blood_type' => 'A+',
                'allergies' => Crypt::encryptString('Alergi lateks'),
                'medical_history' => Crypt::encryptString('Endometriosis ringan. Sedang program hamil.'),
                'current_medications' => Crypt::encryptString('Asam folat, vitamin E'),
                'insurance_number' => 'BPJS-56789012345',
                'insurance_provider' => 'BPJS Kesehatan',
            ],
            [
                'birth_date' => '1987-09-11',
                'address' => 'Jl. Pemuda No. 201, Perumahan Graha Indah Blok B12',
                'province_id' => '35', // Jawa Timur
                'regency_id' => '3578', // Surabaya
                'district_id' => '3578150', // Wonokromo
                'village_id' => '3578150001', // Wonokromo
                'emergency_contact_name' => 'Rudi Hartono (Suami)',
                'emergency_contact_phone' => '+6281234567815',
                'emergency_contact_relation' => 'Suami',
                'blood_type' => 'O+',
                'allergies' => Crypt::encryptString('Alergi telur, kacang-kacangan'),
                'medical_history' => Crypt::encryptString('Persalinan prematur tahun 2020. PCOS ringan.'),
                'current_medications' => Crypt::encryptString('Metformin, inositol'),
                'insurance_number' => 'SWASTA-67890123456',
                'insurance_provider' => 'Allianz',
            ],
            [
                'birth_date' => '1991-04-26',
                'address' => 'Jl. Hayam Wuruk No. 78, RT 06 RW 03, Kelurahan Taman Sari',
                'province_id' => '51', // Bali
                'regency_id' => '5171', // Denpasar
                'district_id' => '5171030', // Denpasar Barat
                'village_id' => '5171030001', // Tegal Harum
                'emergency_contact_name' => 'Made Suartana (Suami)',
                'emergency_contact_phone' => '+6281234567816',
                'emergency_contact_relation' => 'Suami',
                'blood_type' => 'B+',
                'allergies' => Crypt::encryptString('Tidak ada alergi yang diketahui'),
                'medical_history' => Crypt::encryptString('Kehamilan pertama berjalan normal. Tidak ada komplikasi.'),
                'current_medications' => Crypt::encryptString('Vitamin prenatal, DHA'),
                'insurance_number' => 'BPJS-78901234567',
                'insurance_provider' => 'BPJS Kesehatan',
            ],
            [
                'birth_date' => '1989-08-14',
                'address' => 'Jl. Asia Afrika No. 125, Komplex CBD Plaza Tower C Lt. 8',
                'province_id' => '36', // Banten
                'regency_id' => '3671', // Tangerang
                'district_id' => '3671040', // Karawaci
                'village_id' => '3671040001', // Karawaci
                'emergency_contact_name' => 'Indra Wijaya (Suami)',
                'emergency_contact_phone' => '+6281234567817',
                'emergency_contact_relation' => 'Suami',
                'blood_type' => 'A+',
                'allergies' => Crypt::encryptString('Alergi aspirin'),
                'medical_history' => Crypt::encryptString('Hipertensi ringan. Persalinan normal tahun 2021.'),
                'current_medications' => Crypt::encryptString('Amlodipine 5mg, vitamin prenatal'),
                'insurance_number' => 'SWASTA-89012345678',
                'insurance_provider' => 'AXA Mandiri',
            ],
            [
                'birth_date' => '1994-01-30',
                'address' => 'Jl. Cipete Raya No. 99, Perumahan Villa Melati Mas Blok D7',
                'province_id' => '31', // DKI Jakarta
                'regency_id' => '3171', // Jakarta Selatan
                'district_id' => '3171070', // Cipete Utara
                'village_id' => '3171070001', // Cipete Utara
                'emergency_contact_name' => 'Sari Indah (Ibu)',
                'emergency_contact_phone' => '+6281234567818',
                'emergency_contact_relation' => 'Ibu',
                'blood_type' => 'O+',
                'allergies' => Crypt::encryptString('Alergi produk susu'),
                'medical_history' => Crypt::encryptString('Sedang hamil anak kedua. Kehamilan pertama berjalan lancar.'),
                'current_medications' => Crypt::encryptString('Vitamin prenatal, kalsium'),
                'insurance_number' => 'BPJS-90123456789',
                'insurance_provider' => 'BPJS Kesehatan',
            ],
            [
                'birth_date' => '1986-06-18',
                'address' => 'Jl. Kemang Raya No. 234, Apartemen Kemang Village Tower Intercon Lt. 20',
                'province_id' => '31', // DKI Jakarta
                'regency_id' => '3171', // Jakarta Selatan
                'district_id' => '3171080', // Kemang
                'village_id' => '3171080001', // Kemang Selatan
                'emergency_contact_name' => 'Ferry Gunawan (Suami)',
                'emergency_contact_phone' => '+6281234567819',
                'emergency_contact_relation' => 'Suami',
                'blood_type' => 'AB+',
                'allergies' => Crypt::encryptString('Alergi iodine'),
                'medical_history' => Crypt::encryptString('Tiroid hipofungsi ringan. Persalinan caesar 2020 dan 2022.'),
                'current_medications' => Crypt::encryptString('Levothyroxine 50mcg, vitamin prenatal'),
                'insurance_number' => 'SWASTA-01234567890',
                'insurance_provider' => 'Great Eastern',
            ],
        ];

        // Create patient profiles
        foreach ($patientProfiles as $index => $profileData) {
            if (isset($patientUsers[$index])) {
                PatientProfile::create([
                    'user_id' => $patientUsers[$index]->id,
                    ...$profileData
                ]);
            }
        }
    }
}
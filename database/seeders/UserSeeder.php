<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin Users
        User::create([
            'name' => 'Admin HomeCare',
            'email' => 'admin@homecare.com',
            'phone' => '+6281234567890',
            'email_verified_at' => now(),
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@homecare.com',
            'phone' => '+6281234567891',
            'email_verified_at' => now(),
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        // Bidan Users
        $bidanUsers = [
            [
                'name' => 'Bidan Sari Wijayanti',
                'email' => 'sari@bidan.com',
                'phone' => '+6281234567892',
            ],
            [
                'name' => 'Bidan Maya Putri',
                'email' => 'maya@bidan.com',
                'phone' => '+6281234567893',
            ],
            [
                'name' => 'Bidan Dewi Lestari',
                'email' => 'dewi@bidan.com',
                'phone' => '+6281234567894',
            ],
            [
                'name' => 'Bidan Rani Kusuma',
                'email' => 'rani@bidan.com',
                'phone' => '+6281234567895',
            ],
            [
                'name' => 'Bidan Lila Sari',
                'email' => 'lila@bidan.com',
                'phone' => '+6281234567896',
            ],
            [
                'name' => 'Bidan Ayu Cantika',
                'email' => 'ayu@bidan.com',
                'phone' => '+6281234567897',
            ],
            [
                'name' => 'Bidan Fitri Handayani',
                'email' => 'fitri@bidan.com',
                'phone' => '+6281234567898',
            ],
            [
                'name' => 'Bidan Nina Safitri',
                'email' => 'nina@bidan.com',
                'phone' => '+6281234567899',
            ],
        ];

        foreach ($bidanUsers as $bidan) {
            User::create([
                'name' => $bidan['name'],
                'email' => $bidan['email'],
                'phone' => $bidan['phone'],
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
                'role' => 'bidan',
            ]);
        }

        // Patient Users
        $patientUsers = [
            [
                'name' => 'Ibu Rina Sari',
                'email' => 'rina@pasien.com',
                'phone' => '+6281234567800',
            ],
            [
                'name' => 'Ibu Mega Wati',
                'email' => 'mega@pasien.com',
                'phone' => '+6281234567801',
            ],
            [
                'name' => 'Ibu Diana Putri',
                'email' => 'diana@pasien.com',
                'phone' => '+6281234567802',
            ],
            [
                'name' => 'Ibu Siska Rahayu',
                'email' => 'siska@pasien.com',
                'phone' => '+6281234567803',
            ],
            [
                'name' => 'Ibu Tina Maharani',
                'email' => 'tina@pasien.com',
                'phone' => '+6281234567804',
            ],
            [
                'name' => 'Ibu Lisa Andriani',
                'email' => 'lisa@pasien.com',
                'phone' => '+6281234567805',
            ],
            [
                'name' => 'Ibu Yuni Astuti',
                'email' => 'yuni@pasien.com',
                'phone' => '+6281234567806',
            ],
            [
                'name' => 'Ibu Dian Permata',
                'email' => 'dian@pasien.com',
                'phone' => '+6281234567807',
            ],
            [
                'name' => 'Ibu Citra Dewi',
                'email' => 'citra@pasien.com',
                'phone' => '+6281234567808',
            ],
            [
                'name' => 'Ibu Wulan Sari',
                'email' => 'wulan@pasien.com',
                'phone' => '+6281234567809',
            ],
        ];

        foreach ($patientUsers as $patient) {
            User::create([
                'name' => $patient['name'],
                'email' => $patient['email'],
                'phone' => $patient['phone'],
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
                'role' => 'pasien',
            ]);
        }
    }
}
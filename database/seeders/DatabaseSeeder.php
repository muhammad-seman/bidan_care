<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Create admin user
        User::factory()->create([
            'name' => 'Admin HomeCare',
            'email' => 'admin@homecare.com',
            'role' => 'admin',
        ]);

        // Create bidan user
        User::factory()->create([
            'name' => 'Bidan Sari',
            'email' => 'bidan@homecare.com',
            'role' => 'bidan',
        ]);

        // Create pasien user
        User::factory()->create([
            'name' => 'Ibu Rina',
            'email' => 'pasien@homecare.com',
            'role' => 'pasien',
        ]);
    }
}

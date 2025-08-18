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
        $this->call([
            // Order is important due to foreign key relationships
            UserSeeder::class,           // Must run first - creates users
            BidanProfileSeeder::class,   // Depends on users
            PatientProfileSeeder::class, // Depends on users  
            BidanServiceSeeder::class,   // Depends on bidan profiles
        ]);

        $this->command->info('🎉 Database seeded successfully!');
        $this->command->info('');
        $this->command->info('📋 Sample Data Created:');
        $this->command->info('👨‍💼 Admin Users: 2 (admin@homecare.com, superadmin@homecare.com)');
        $this->command->info('👩‍⚕️ Bidan Users: 8 (sari@bidan.com, maya@bidan.com, etc.)');
        $this->command->info('👶 Patient Users: 10 (rina@pasien.com, mega@pasien.com, etc.)');
        $this->command->info('🏥 Bidan Profiles: 8 (various verification statuses)');
        $this->command->info('👤 Patient Profiles: 10 (with encrypted medical data)');
        $this->command->info('🔧 Bidan Services: ~40+ services across verified bidan');
        $this->command->info('');
        $this->command->info('🔑 Default password for all users: password123');
        $this->command->info('');
        $this->command->info('✅ Ready for testing!');
    }
}

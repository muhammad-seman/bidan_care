<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bidan_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // License & Verification
            $table->string('license_number')->unique();
            $table->string('license_file_path')->nullable();
            $table->enum('verification_status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamp('verified_at')->nullable();
            $table->foreignId('verified_by')->nullable()->constrained('users');
            
            // Location using external API IDs
            $table->string('province_id');
            $table->string('regency_id');
            $table->string('district_id');
            $table->string('village_id');
            $table->text('detailed_address');
            $table->text('google_maps_link')->nullable();
            
            // Professional Info
            $table->text('bio')->nullable();
            $table->integer('experience_years')->default(0);
            $table->json('certification_files')->nullable(); // Array of file paths
            $table->string('phone')->nullable();
            $table->date('birth_date')->nullable();
            
            // Practice Info
            $table->enum('practice_type', ['home_visit', 'clinic', 'both'])->default('both');
            $table->text('specializations')->nullable();
            $table->boolean('emergency_available')->default(false);
            
            // Status
            $table->boolean('is_active')->default(true);
            $table->decimal('rating_average', 3, 2)->default(0);
            $table->integer('total_reviews')->default(0);
            $table->integer('total_patients')->default(0);
            
            $table->timestamps();
            
            // Indexes
            $table->index(['province_id', 'regency_id']);
            $table->index('verification_status');
            $table->index(['is_active', 'verification_status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bidan_profiles');
    }
};

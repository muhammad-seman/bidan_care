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
            $table->string('specialization'); // Single specialization for simplicity
            $table->integer('experience_years')->default(0);
            $table->text('bio')->nullable();
            $table->enum('verification_status', ['pending', 'verified', 'rejected'])->default('pending');
            $table->timestamp('verified_at')->nullable();
            $table->foreignId('verified_by')->nullable()->constrained('users');
            $table->text('verification_notes')->nullable();
            
            // Location using external API IDs
            $table->string('province_id');
            $table->string('regency_id');
            $table->string('district_id');
            $table->string('village_id');
            $table->text('detailed_address');
            $table->text('google_maps_link')->nullable();
            
            // Document URLs
            $table->string('license_document_url')->nullable();
            $table->string('certification_document_url')->nullable();
            $table->string('profile_photo_url')->nullable();
            
            // Practice Info
            $table->enum('practice_type', ['home_visit', 'clinic', 'both'])->default('both');
            $table->boolean('emergency_available')->default(false);
            
            // Status
            $table->boolean('is_active')->default(false); // Default false until verified
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

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
        Schema::create('patient_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // Personal Info
            $table->date('birth_date')->nullable();
            $table->enum('gender', ['female', 'male'])->nullable();
            $table->string('phone')->nullable();
            $table->string('id_number')->nullable(); // KTP/ID
            
            // Location
            $table->string('province_id')->nullable();
            $table->string('regency_id')->nullable();
            $table->string('district_id')->nullable();
            $table->string('village_id')->nullable();
            $table->text('address')->nullable();
            
            // Emergency Contact
            $table->string('emergency_contact_name')->nullable();
            $table->string('emergency_contact_phone')->nullable();
            $table->string('emergency_contact_relation')->nullable();
            
            // Medical Info (encrypted)
            $table->text('medical_history')->nullable();
            $table->text('allergies')->nullable();
            $table->text('current_medications')->nullable();
            $table->enum('blood_type', ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'])->nullable();
            
            // Insurance
            $table->string('insurance_provider')->nullable();
            $table->string('insurance_number')->nullable();
            
            // Preferences
            $table->boolean('home_visit_preference')->default(true);
            $table->json('preferred_bidan_ids')->nullable(); // Favorite bidan
            $table->text('special_notes')->nullable();
            
            $table->timestamps();
            
            // Indexes
            $table->index(['province_id', 'regency_id']);
            $table->unique('id_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_profiles');
    }
};

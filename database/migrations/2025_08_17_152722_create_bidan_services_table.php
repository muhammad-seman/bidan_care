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
        Schema::create('bidan_services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bidan_id')->constrained('bidan_profiles')->onDelete('cascade');
            
            // Service Details
            $table->string('service_name');
            $table->text('description');
            $table->decimal('price', 10, 2); // Bidan set own price
            $table->integer('duration_minutes')->default(60); // Duration in minutes
            
            // Service Type
            $table->enum('service_type', ['home_visit', 'clinic']); 
            $table->enum('category', [
                'konsultasi_kehamilan',
                'perawatan_pasca_melahirkan', 
                'pemeriksaan_rutin',
                'konsultasi_umum',
                'emergency_care',
                'prenatal_care',
                'postnatal_care',
                'lainnya'
            ])->default('konsultasi_umum');
            
            // Availability & Requirements
            $table->json('requirements')->nullable(); // Special requirements
            $table->json('included_services')->nullable(); // What's included
            $table->text('preparation_notes')->nullable(); // What patient should prepare
            
            // Booking Rules
            $table->integer('min_booking_hours')->default(2); // Minimum hours before booking
            $table->integer('max_advance_days')->default(30); // Max days in advance
            $table->boolean('allow_reschedule')->default(true);
            $table->boolean('allow_cancellation')->default(true);
            $table->integer('cancellation_hours')->default(24); // Hours before can cancel
            
            // Status
            $table->boolean('is_active')->default(true);
            $table->integer('total_bookings')->default(0);
            $table->decimal('average_rating', 3, 2)->default(0);
            
            $table->timestamps();
            
            // Indexes
            $table->index(['bidan_id', 'is_active']);
            $table->index(['service_type', 'category']);
            $table->index('category');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bidan_services');
    }
};

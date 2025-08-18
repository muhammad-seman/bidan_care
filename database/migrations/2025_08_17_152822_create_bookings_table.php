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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('booking_number')->unique(); // BK-2025-XXXXXX
            
            // Core Relations
            $table->foreignId('patient_id')->constrained('users');
            $table->foreignId('bidan_service_id')->constrained('bidan_services');
            $table->foreignId('availability_id')->nullable()->constrained('bidan_availability');
            
            // Schedule
            $table->date('booking_date');
            $table->time('start_time');
            $table->time('end_time');
            $table->integer('duration_minutes');
            
            // Location & Service Type
            $table->enum('service_type', ['home_visit', 'clinic']);
            $table->text('service_location')->nullable(); // Clinic address or patient address
            
            // Patient Location (for home visit)
            $table->string('patient_province_id')->nullable();
            $table->string('patient_regency_id')->nullable();
            $table->string('patient_district_id')->nullable();
            $table->string('patient_village_id')->nullable();
            $table->text('patient_address')->nullable();
            $table->text('patient_address_notes')->nullable();
            
            // Financial
            $table->decimal('service_price', 10, 2);
            $table->decimal('platform_fee', 10, 2); // 10% of service_price
            $table->decimal('total_amount', 10, 2); // service_price + platform_fee
            $table->decimal('bidan_amount', 10, 2); // service_price (after completion)
            
            // Status
            $table->enum('status', [
                'pending_payment',    // Waiting for payment
                'confirmed',          // Payment confirmed, waiting for service
                'in_progress',        // Service is happening
                'completed',          // Service completed
                'cancelled_by_patient',
                'cancelled_by_bidan', 
                'cancelled_by_admin',
                'refunded',
                'rescheduled'
            ])->default('pending_payment');
            
            $table->enum('payment_status', [
                'unpaid',
                'paid',
                'refunded',
                'released_to_bidan',
                'partial_refund'
            ])->default('unpaid');
            
            // Important Timestamps
            $table->timestamp('confirmed_at')->nullable();
            $table->timestamp('service_started_at')->nullable();
            $table->timestamp('service_completed_at')->nullable();
            $table->timestamp('cancelled_at')->nullable();
            $table->timestamp('payment_due_at')->nullable(); // Payment deadline
            
            // Cancellation & Rescheduling
            $table->string('cancellation_reason')->nullable();
            $table->foreignId('cancelled_by')->nullable()->constrained('users');
            $table->foreignId('rescheduled_from_booking_id')->nullable()->constrained('bookings');
            $table->boolean('is_rescheduled')->default(false);
            
            // Notes & Requirements
            $table->text('patient_notes')->nullable(); // Special requests from patient
            $table->text('bidan_notes')->nullable();   // Notes from bidan
            $table->text('admin_notes')->nullable();   // Admin notes
            $table->json('special_requirements')->nullable(); // JSON array of requirements
            
            // Review Status
            $table->boolean('patient_reviewed')->default(false);
            $table->boolean('bidan_reviewed')->default(false);
            
            $table->timestamps();
            
            // Indexes
            $table->index(['patient_id', 'status']);
            $table->index(['bidan_id', 'status']);
            $table->index(['booking_date', 'start_time']);
            $table->index('status');
            $table->index('payment_status');
            $table->index(['booking_date', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};

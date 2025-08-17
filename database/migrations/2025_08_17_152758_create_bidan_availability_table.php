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
        Schema::create('bidan_availability', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bidan_id')->constrained('bidan_profiles')->onDelete('cascade');
            
            // Date & Time Slots
            $table->date('available_date');
            $table->time('start_time');
            $table->time('end_time');
            
            // Availability Status
            $table->boolean('is_available')->default(true);
            $table->enum('status', ['available', 'booked', 'blocked', 'completed'])->default('available');
            
            // Optional linked booking
            $table->foreignId('booking_id')->nullable()->constrained()->onDelete('set null');
            
            // Repeat Pattern (for recurring availability)
            $table->enum('repeat_type', ['none', 'daily', 'weekly', 'monthly'])->default('none');
            $table->date('repeat_until')->nullable();
            $table->json('repeat_days')->nullable(); // For weekly: [1,2,3] = Mon,Tue,Wed
            
            // Service Type Restrictions
            $table->json('allowed_service_types')->nullable(); // ['home_visit', 'clinic']
            $table->integer('max_bookings')->default(1); // Multiple bookings per slot if needed
            $table->integer('current_bookings')->default(0);
            
            // Notes
            $table->text('notes')->nullable();
            
            $table->timestamps();
            
            // Indexes
            $table->index(['bidan_id', 'available_date']);
            $table->index(['available_date', 'start_time']);
            $table->index(['status', 'is_available']);
            $table->unique(['bidan_id', 'available_date', 'start_time']); // Prevent duplicate slots
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bidan_availability');
    }
};

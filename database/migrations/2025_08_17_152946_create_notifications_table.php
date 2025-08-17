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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // Notification Details
            $table->string('type'); // booking.confirmed, payment.received, etc
            $table->string('title');
            $table->text('message');
            $table->json('data')->nullable(); // Additional data (booking_id, etc)
            
            // Related Entity
            $table->string('notifiable_type')->nullable(); // Booking, Payment, etc
            $table->unsignedBigInteger('notifiable_id')->nullable();
            
            // Status
            $table->timestamp('read_at')->nullable();
            $table->boolean('is_important')->default(false);
            $table->enum('priority', ['low', 'normal', 'high', 'urgent'])->default('normal');
            
            // Action URL
            $table->string('action_url')->nullable(); // URL to redirect when clicked
            $table->string('action_text')->nullable(); // Button text
            
            $table->timestamps();
            
            // Indexes
            $table->index(['user_id', 'read_at']);
            $table->index(['user_id', 'created_at']);
            $table->index(['notifiable_type', 'notifiable_id']);
            $table->index('type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};

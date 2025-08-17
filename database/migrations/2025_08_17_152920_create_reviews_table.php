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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained()->onDelete('cascade');
            $table->foreignId('patient_id')->constrained('users');
            $table->foreignId('bidan_id')->constrained('bidan_profiles');
            
            // Rating & Review
            $table->tinyInteger('rating')->unsigned(); // 1-5 stars
            $table->text('review_text')->nullable();
            $table->boolean('is_anonymous')->default(false);
            
            // Detailed Ratings
            $table->tinyInteger('communication_rating')->nullable(); // 1-5
            $table->tinyInteger('professionalism_rating')->nullable(); // 1-5  
            $table->tinyInteger('punctuality_rating')->nullable(); // 1-5
            $table->tinyInteger('service_quality_rating')->nullable(); // 1-5
            
            // Review Status
            $table->boolean('is_published')->default(true);
            $table->boolean('is_verified')->default(false); // Admin verified
            $table->timestamp('verified_at')->nullable();
            $table->foreignId('verified_by')->nullable()->constrained('users');
            
            // Moderation
            $table->boolean('is_flagged')->default(false);
            $table->text('flag_reason')->nullable();
            $table->foreignId('flagged_by')->nullable()->constrained('users');
            
            // Bidan Response
            $table->text('bidan_response')->nullable();
            $table->timestamp('bidan_responded_at')->nullable();
            
            // Helpful Votes (if needed later)
            $table->integer('helpful_votes')->default(0);
            $table->integer('not_helpful_votes')->default(0);
            
            $table->timestamps();
            
            // Indexes
            $table->index(['bidan_id', 'is_published']);
            $table->index(['rating', 'is_published']);
            $table->index('booking_id');
            $table->unique(['booking_id', 'patient_id']); // One review per booking per patient
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};

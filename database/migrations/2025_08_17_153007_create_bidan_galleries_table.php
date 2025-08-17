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
        Schema::create('bidan_galleries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bidan_id')->constrained('bidan_profiles')->onDelete('cascade');
            
            // File Details
            $table->string('file_path');
            $table->string('file_name');
            $table->string('file_type'); // image, document, certificate
            $table->string('mime_type');
            $table->integer('file_size'); // in bytes
            
            // Display Info
            $table->string('title')->nullable();
            $table->text('caption')->nullable();
            $table->text('description')->nullable();
            
            // Organization
            $table->enum('category', [
                'profile_photo',
                'clinic_photos',
                'certificates', 
                'work_samples',
                'before_after',
                'testimonials',
                'equipment',
                'other'
            ])->default('other');
            
            $table->integer('sort_order')->default(0);
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_public')->default(true);
            
            // Moderation
            $table->boolean('is_approved')->default(false);
            $table->timestamp('approved_at')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users');
            $table->text('rejection_reason')->nullable();
            
            $table->timestamps();
            
            // Indexes
            $table->index(['bidan_id', 'category']);
            $table->index(['bidan_id', 'is_public', 'is_approved']);
            $table->index(['category', 'is_featured']);
            $table->index('sort_order');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bidan_galleries');
    }
};

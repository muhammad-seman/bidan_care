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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('payment_number')->unique(); // PAY-2025-XXXXXX
            $table->foreignId('booking_id')->constrained()->onDelete('cascade');
            
            // Payment Details
            $table->decimal('amount', 12, 2); // Total amount paid by patient
            $table->decimal('service_amount', 12, 2); // Amount for bidan
            $table->decimal('platform_fee', 12, 2); // 10% platform fee
            $table->decimal('refund_amount', 12, 2)->default(0);
            
            // Payment Method & Gateway
            $table->enum('payment_method', [
                'bank_transfer',
                'e_wallet_gopay',
                'e_wallet_ovo', 
                'e_wallet_dana',
                'credit_card',
                'debit_card',
                'virtual_account'
            ]);
            $table->string('payment_gateway')->nullable(); // midtrans, xendit, etc
            $table->string('gateway_reference')->nullable(); // Transaction ID from gateway
            
            // Escrow Status
            $table->enum('status', [
                'pending',           // Waiting for payment
                'paid',              // Money received in escrow
                'released',          // Money released to bidan
                'refunded',          // Money refunded to patient
                'partial_refunded',  // Partial refund issued
                'failed',            // Payment failed
                'cancelled'          // Payment cancelled
            ])->default('pending');
            
            // Timestamps
            $table->timestamp('paid_at')->nullable();
            $table->timestamp('released_at')->nullable();
            $table->timestamp('refunded_at')->nullable();
            $table->timestamp('expires_at')->nullable(); // Payment expiry
            
            // Gateway Response
            $table->json('gateway_response')->nullable(); // Full gateway response
            $table->text('failure_reason')->nullable();
            
            // Release Details
            $table->foreignId('released_by')->nullable()->constrained('users'); // Admin who released
            $table->text('release_notes')->nullable();
            
            // Refund Details
            $table->foreignId('refunded_by')->nullable()->constrained('users'); // Admin who refunded
            $table->text('refund_reason')->nullable();
            $table->string('refund_reference')->nullable(); // Refund transaction ID
            
            $table->timestamps();
            
            // Indexes
            $table->index(['booking_id', 'status']);
            $table->index('payment_method');
            $table->index('status');
            $table->index(['status', 'paid_at']);
            $table->index('gateway_reference');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};

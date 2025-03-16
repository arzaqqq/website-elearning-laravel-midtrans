<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Foreign key to users
            $table->foreignId('pricing_id')->constrained()->onDelete('cascade'); // Foreign key to pricing

            $table->string('booking_trx_id'); // Booking transaction ID

            $table->unsignedInteger('sub_total_amount'); // Subtotal amount
            $table->unsignedInteger('grand_total_amount'); // Grand total amount
            $table->unsignedInteger('total_tax_amount'); // Total tax amount

            $table->boolean('is_paid'); // Payment status
            $table->string('payment_type'); // Payment type (e.g., card, bank transfer)
            $table->string('proof')->nullable(); // Optional proof of payment

            $table->date('started_at'); // Start date
            $table->date('ended_at'); // End date
            
            $table->timestamps(); // Created at and updated at
            $table->softDeletes(); // Soft delete support
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};

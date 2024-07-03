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

            // Foreign key to orders table
            $table->string('order_transaction_id');
            $table->foreign('order_transaction_id')->references('transaction_id')->on('orders')->onDelete('cascade');

            // payment_date
            $table->date('payment_date')->nullable();
            // payment_due_date in YYYY-MM-DD 23:59:59
            $table->dateTime('payment_due_date')->nullable();

            // payment_amount
            $table->unsignedBigInteger('payment_amount')->nullable();
            $table->string('payment_proof_document')->nullable();
            // installment_number (Misalkan pembayaran pertama dari total 3 kali pembayaran)
            $table->unsignedTinyInteger('installment_number')->nullable();
            // total_installments (Maksimal 3 kali pembayaran)
            $table->integer('total_installments')->nullable();
            $table->enum('payment_status', ['pending', 'approved', 'rejected']);

            // approved_at
            $table->dateTime('approved_at')->nullable();
            // rejected_at
            $table->dateTime('rejected_at')->nullable();
            $table->timestamps();
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

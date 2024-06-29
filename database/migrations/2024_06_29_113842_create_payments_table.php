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
            $table->string('transaction_id');
            $table->foreign('transaction_id')->references('transaction_id')->on('orders')->onUpdate('cascade')->onDelete('cascade');
            // payment_date
            $table->date('payment_date');
            // payment_due_date in YYYY-MM-DD 23:59:59
            $table->dateTime('payment_due_date');

            // payment_amount
            $table->unsignedBigInteger('payment_amount');
            $table->string('payment_proof_document');
            // installment_number (Misalkan pembayaran pertama dari total 3 kali pembayaran)
            $table->unsignedTinyInteger('installment_number')->nullable();
            // total_installments (Maksimal 3 kali pembayaran)
            $table->unsignedBigInteger('total_installments')->nullable();
            $table->enum('payment_status', ['pending', 'approved', 'rejected']);
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

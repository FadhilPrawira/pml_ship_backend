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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            // Foreign key to orders table
            $table->string('order_transaction_id');
            $table->foreign('order_transaction_id')->references('transaction_id')->on('orders')->onDelete('cascade');

            $table->string('document_name')->nullable();
            $table->enum('document_type', ['shipping_instruction', 'SPAL', 'bill_of_lading', 'cargo_manifest', 'time_sheet', 'draught_survey']);
            $table->timestampTz('uploaded_at', precision: 0)->nullable();
            // max input document
            $table->timestampTz('max_input_document_at', precision: 0)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};

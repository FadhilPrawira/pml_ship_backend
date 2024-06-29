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
            $table->string('transaction_id');
            $table->string('document_name');
            $table->enum('document_type', ['shipping_instruction', 'bill_of_lading', 'cargo_manifest', 'time_sheet', 'draught_survey']);
            $table->timestamps();
            $table->foreign('transaction_id')->references('transaction_id')->on('orders')->onUpdate('cascade')->onDelete('cascade');
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

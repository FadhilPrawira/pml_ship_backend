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
        Schema::create('conferences', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_id')->unique();
            $table->foreignId('customer_company_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->enum('conference_type', ['offline', 'online'])->default('offline');
            //            In column 'location', you can input Gedung/Alamat or Zoom/Gmeet. The link will be provided later by email
            $table->string('location')->nullable();
            $table->date('conference_date')->nullable();
            $table->string('conference_time')->nullable();
            $table->timestampTz('conference_approved_at', precision: 0)->nullable();
            $table->timestampTz('conference_rejected_at', precision: 0)->nullable();
            $table->timestamps();
            $table->foreign('transaction_id')->references('transaction_id')->on('orders')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conferences');
    }
};

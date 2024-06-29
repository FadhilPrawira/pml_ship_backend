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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            // transaction_id
            $table->string('transaction_id');
            $table->index('transaction_id');
            // user id
            $table->foreignId('user_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->string('shipper_name')->nullable();
            $table->string('shipper_address')->nullable();
            $table->string('consignee_name')->nullable();
            $table->string('consignee_address')->nullable();
            // port_of_loading_id
            $table->foreignId('port_of_loading_id')->nullable()->constrained('ports')->onUpdate('cascade')->onDelete('cascade');
            // port_of_discharge_id
            $table->foreignId('port_of_discharge_id')->nullable()->constrained('ports')->onUpdate('cascade')->onDelete('cascade');
            // vessel_id
            $table->foreignId('vessel_id')->nullable()->constrained('vessels')->onUpdate('cascade')->onDelete('cascade');

            $table->date('date_of_loading')->nullable();
            $table->date('date_of_discharge')->nullable();
            $table->enum('status', ['order_pending', 'payment_pending', 'on_shipping', 'order_completed', 'order_canceled', 'order_rejected']);
            $table->text('cargo_description')->nullable();
            $table->string('cargo_weight')->nullable();

            $table->unsignedBigInteger('shipping_cost')->nullable();
            $table->unsignedBigInteger('handling_cost')->nullable();
            $table->unsignedBigInteger('biaya_parkir_pelabuhan')->nullable();
            $table->unsignedBigInteger('tax')->nullable();
            $table->unsignedBigInteger('total_bill')->nullable();
            // Sudah bayar berapa rupiah?
            $table->string('cumulative_paid')->nullable();
            // rating_star
            $table->integer('rating_star')->nullable();
            // review
            $table->text('review')->nullable();
            // approved_at
            $table->timestampTz('negotiation_or_order_approved_at', precision: 0)->nullable();
            // rejected_at
            $table->timestampTz('order_rejected_at', precision: 0)->nullable();
            // canceled_at
            $table->timestampTz('order_canceled_at', precision: 0)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};

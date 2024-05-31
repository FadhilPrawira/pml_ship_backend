<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            // transaction_id
            $table->string('transaction_id');
            // user id
            $table->foreignId('user_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            // shipper_name
            $table->string('shipper_name')->nullable();
//            $table->string('shipper_name');
            // shipper_address
            $table->string('shipper_address')->nullable();
//            $table->string('shipper_address');
            // consignee_name
            $table->string('consignee_name')->nullable();
//            $table->string('consignee_name');
            // consignee_address
            $table->string('consignee_address')->nullable();
//            $table->string('consignee_address');
            // port_of_loading_id
            $table->foreignId('port_of_loading_id')->nullable()->constrained('ports')->onUpdate('cascade')->onDelete('cascade');
//            $table->foreignId('port_of_loading_id')->constrained('ports')->onUpdate('cascade')->onDelete('cascade');
            // port_of_discharge_id
            $table->foreignId('port_of_discharge_id')->nullable()->constrained('ports')->onUpdate('cascade')->onDelete('cascade');
//            $table->foreignId('port_of_discharge_id')->constrained('ports')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('vessel_id')->nullable()->constrained('vessels')->onUpdate('cascade')->onDelete('cascade');
            // date_of_loading
            $table->date('date_of_loading')->nullable();
//            $table->date('date_of_loading');
            // date_of_discharge
            $table->date('date_of_discharge')->nullable();
//            $table->date('date_of_discharge');
            // status
            $table->enum('status', ['order_pending','order_still_verified_by_admin', 'payment_pending', 'on_shipping', 'order_shipped', 'payment_done', 'order_completed', 'order_canceled']);
            // cargo_description
            $table->text('cargo_description')->nullable();
//            $table->text('cargo_description');
            // cargo_weight
            $table->string('cargo_weight')->nullable();
//            $table->string('cargo_weight');
            // total_cost
            $table->unsignedBigInteger('shipping_cost')->nullable();
            $table->unsignedBigInteger('handling_cost')->nullable();
            $table->unsignedBigInteger('biaya_parkir_pelabuhan')->nullable();
            $table->unsignedBigInteger('tax')->nullable();
            $table->unsignedBigInteger('total_cost')->nullable();
//            $table->string('total_cost');
            // shipping_instruction_document_url
            $table->string('shipping_instruction_document_url')->nullable();
            // bill_of_lading_document_url
            $table->string('bill_of_lading_document_url')->nullable();
            // cargo_manifest_document_url
            $table->string('cargo_manifest_document_url')->nullable();
            // time_sheet_document_url
            $table->string('time_sheet_document_url')->nullable();
            // draught_survey_document_url
            $table->string('draught_survey_document_url')->nullable();
            // rating_star
            $table->integer('rating_star')->nullable();
            // review
            $table->text('review')->nullable();
            $table->timestampTz('negotiation_approved_at', precision: 0)->nullable();
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

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
        Schema::create('vessel_routes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('port_of_loading_id')->nullable()->constrained('ports')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('port_of_discharge_id')->nullable()->constrained('ports')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('day_estimation');
            $table->unsignedBigInteger('shipping_cost');
            $table->unsignedBigInteger('handling_cost');
            $table->unsignedBigInteger('biaya_parkir_pelabuhan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vessel_routes');
    }
};

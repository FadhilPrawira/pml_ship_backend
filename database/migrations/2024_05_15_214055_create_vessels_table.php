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
        Schema::create('vessels', function (Blueprint $table) {
            $table->id();
            $table->string('vessel_name');
            $table->string('vessel_type');
            $table->string('imo_number');
            $table->string('mmsi_number');
            $table->string('vessel_status');
            $table->string('vessel_vts_speed_knot');
            $table->string('vessel_calc_speed_knot');
            $table->string('vessel_heading_degree');
            $table->string('vessel_tx_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vessels');
    }
};

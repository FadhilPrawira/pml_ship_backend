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
            $table->string('vessel_lat')->nullable();
            $table->string('vessel_lon')->nullable();
            $table->string('vessel_vts_speed_knot')->nullable();
            $table->string('vessel_calc_speed_knot')->nullable();
            $table->string('vessel_heading_degree')->nullable();
            $table->string('vessel_tx_id');
            $table->string('pml_internal_vessel_id');
            $table->timestamp('pml_last_updated_at')->nullable();
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

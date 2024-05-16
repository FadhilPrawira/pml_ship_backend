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
        Schema::create('ports', function (Blueprint $table) {
            $table->id();
            // name
            $table->string('name');
            // address
            $table->string('address')->nullable();
            // country_code ISO 3166-1 alpha-2
            $table->string('country_code')->nullable();
            // unlocode
            $table->string('unlocode')->nullable();
            // latitude
            $table->string('latitude')->nullable();
            // longitude
            $table->string('longitude')->nullable();
            // open_time (format: 08:00)
            $table->time('open_time')->nullable();
            // close_time (format: 17:00)
            $table->time('close_time')->nullable();
            // image_url
            $table->string('image_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ports');
    }
};

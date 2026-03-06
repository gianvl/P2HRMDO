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
        Schema::create('forecast_section8s', function (Blueprint $table) {
            $table->id('grand_total_id');
            $table->unsignedBigInteger('forecast_num_id'); 
            $table->bigInteger('grandt1st')->nullable();
            $table->bigInteger('grand2nd')->nullable();
            $table->bigInteger('forecastgrandtotal')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('forecast_section8s');
    }
};

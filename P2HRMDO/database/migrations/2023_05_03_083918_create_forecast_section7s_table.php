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
        Schema::create('forecast_section7s', function (Blueprint $table) {
            $table->id('servsubj_id');
            $table->unsignedBigInteger('forecast_num_id'); 
            $table->string('servsubj')->nullable();
            $table->bigInteger('ssubj1stnumsectopened')->nullable();
            $table->bigInteger('ssubj2ndnumsectopened')->nullable();
            $table->bigInteger('Total1s2sForecastServSubject')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('forecast_section7s');
    }
};

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
        Schema::create('forecast_section3s', function (Blueprint $table) {
            $table->id('freplacement_id');
            $table->unsignedBigInteger('forecast_num_id'); 
            $table->string('namefacreplace')->nullable();
            $table->string('reasonreplace')->nullable();
            $table->string('reasonforhiring')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('forecast_section3s');
    }
};

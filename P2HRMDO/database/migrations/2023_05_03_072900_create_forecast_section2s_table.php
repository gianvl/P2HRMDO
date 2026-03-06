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
        Schema::create('forecast_section2s', function (Blueprint $table) {
            $table->id('emc_id');
            $table->unsignedBigInteger('forecast_num_id'); 
            $table->integer('fulltimeperm')->default(0);
            $table->integer('parttimeperm')->default(0);
            $table->integer('fulltimecontrac')->default(0);
            $table->integer('parttimecontrac')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('forecast_section2s');
    }
};

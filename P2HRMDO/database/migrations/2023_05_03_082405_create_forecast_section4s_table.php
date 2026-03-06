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
        Schema::create('forecast_section4s', function (Blueprint $table) {
            $table->id('additional_fac_id');
            $table->unsignedBigInteger('forecast_num_id'); 
            $table->integer('numaddfacmember')->nullable();
            $table->integer('jspermfull')->nullable();
            $table->integer('jspermpart')->nullable();
            $table->integer('jscontracfull')->nullable();
            $table->integer('jscontracpart')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('forecast_section4s');
    }
};

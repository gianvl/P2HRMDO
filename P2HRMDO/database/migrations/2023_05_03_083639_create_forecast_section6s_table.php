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
        Schema::create('forecast_section6s', function (Blueprint $table) {
            $table->id('majorsubj_id');
            $table->unsignedBigInteger('forecast_num_id'); 

            $table->string('aydropdown1s')->nullable();
            $table->string('aydropdown2s')->nullable();
            $table->string('forecastSemester')->nullable();

            $table->bigInteger('studentpop1y1s')->nullable();
            $table->bigInteger('studentpop1y2s')->nullable();
            $table->bigInteger('Total1y1s2sstudent')->nullable();

            $table->bigInteger('numsectopened1y1s')->nullable();
            $table->bigInteger('numsectopened1y2s')->nullable();
            $table->bigInteger('Total1y1s2ssection')->nullable();

            $table->bigInteger('studentpop2y1s')->nullable();
            $table->bigInteger('studentpop2y2s')->nullable();
            $table->bigInteger('Total2y1s2sstudent')->nullable();

            $table->bigInteger('numsectopened2y1s')->nullable();
            $table->bigInteger('numsectopened2y2s')->nullable();
            $table->bigInteger('Total2y1s2ssection')->nullable();
            
            $table->bigInteger('studentpop3y1s')->nullable();
            $table->bigInteger('studentpop3y2s')->nullable();
            $table->bigInteger('Total3y1s2sstudent')->nullable();

            $table->bigInteger('numsectopened3y1s')->nullable();
            $table->bigInteger('numsectopened3y2s')->nullable();
            $table->bigInteger('Total3y1s2ssection')->nullable();

            $table->bigInteger('studentpop4y1s')->nullable();
            $table->bigInteger('studentpop4y2s')->nullable();
            $table->bigInteger('Total4y1s2sstudent')->nullable();

            $table->bigInteger('numsectopened4y1s')->nullable();
            $table->bigInteger('numsectopened4y2s')->nullable();
            $table->bigInteger('Total4y1s2ssection')->nullable();

            $table->bigInteger('studentpop5y1s')->nullable();
            $table->bigInteger('studentpop5y2s')->nullable();
            $table->bigInteger('Total5y1s2sstudent')->nullable();

            $table->bigInteger('numsectopened5y1s')->nullable();
            $table->bigInteger('numsectopened5y2s')->nullable();
            $table->bigInteger('Total5y1s2ssection')->nullable();

            $table->bigInteger('Total1sstudent')->nullable();
            $table->bigInteger('Total2sstudent')->nullable();
            $table->bigInteger('TotalStudentForecast')->nullable();

            $table->bigInteger('Total1ssection')->nullable();
            $table->bigInteger('Total2ssection')->nullable();
            $table->bigInteger('TotalSectionForecast')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('forecast_section6s');
    }
};

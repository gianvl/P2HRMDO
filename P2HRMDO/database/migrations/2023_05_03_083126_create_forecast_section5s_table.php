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
        Schema::create('forecast_section5s', function (Blueprint $table) {
            $table->id('jobspec_id');
            $table->unsignedBigInteger('forecast_num_id'); 
            $table->string('jsbachelor')->nullable();
            $table->string('jsmasters')->nullable();
            $table->string('jsalliedprog')->nullable();
            $table->string('yrsofteachexp')->nullable();
            $table->string('technicalskills')->nullable();
            $table->string('interpersonalskills')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('forecast_section5s');
    }
};

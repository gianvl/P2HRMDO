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
        Schema::create('forecast_section1s', function (Blueprint $table) {
            $table->id('forecast_num_id');
            $table->string('college');
            $table->string('department');
            $table->string('ay');
            $table->string('semester');
            $table->string('chairsignature')->nullable();
            $table->string('deansignature')->nullable();
            $table->string('approval_status')->default('Pending'); // Add approval_status column with default value 'Pending'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('forecast_section1s');
    }
};

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
        Schema::create('manpower_processing_hiree', function (Blueprint $table) {
            $table->id('mrNumHiree');
            $table->unsignedBigInteger('mrNumProcessing'); 
            $table->string('hireeName')->nullable();
            $table->string('hireeDate')->nullable();
            $table->integer('hireeRate')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('manpower_processing_hiree');
    }
};

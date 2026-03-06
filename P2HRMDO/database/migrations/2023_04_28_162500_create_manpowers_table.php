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
        Schema::create('manpowers', function (Blueprint $table) {
            $table->id('mrNum');
            $table->string('college')->nullable();
            $table->string('department')->nullable();
            $table->integer('num_emp_required')->nullable();
            $table->string('employment_status')->nullable();
            $table->string('position')->nullable();
            $table->string('category')->nullable();
            $table->string('category_textbox')->nullable();
            $table->string('replacement_dropdown')->nullable();
            $table->string('replacement_others_textbox')->nullable();
            $table->string('budget')->nullable();
            $table->string('fileInput')->nullable();
            $table->string('expertise_textbox')->nullable();
            $table->integer('regular')->nullable();
            $table->integer('probationary')->nullable();
            $table->integer('contractual')->nullable();
            $table->integer('studassistant')->nullable();
            $table->integer('total')->nullable();
            $table->string('approval_status')->nullable();
            $table->string('chairsignature')->nullable();
            $table->string('deansignature')->nullable();
            $table->string('daterequested')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('manpowers');
    }
};

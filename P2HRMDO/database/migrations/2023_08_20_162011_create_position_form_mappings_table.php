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
        Schema::create('position_form_mappings', function (Blueprint $table) {
            $table->id();
            $table->string('position');
            $table->string('college')->nullable();
            $table->string('department')->nullable();
            $table->string('forms_college_column')->nullable();
            $table->text('forms_department_column')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('position_form_mappings');
    }
};

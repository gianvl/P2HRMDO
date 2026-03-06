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
        Schema::create('eval_pages', function (Blueprint $table) {
            $table->id();
            $table->integer('employee_id')->nullable();
            $table->string('ay')->nullable();
            $table->string('semester')->nullable();
            $table->string('awolna')->nullable();
            $table->integer('absences')->nullable();
            $table->double('student')->nullable();
            $table->double('peer')->nullable();
            $table->double('dean')->nullable();
            $table->double('chairperson')->nullable();
            $table->string('empstatus')->nullable();
            $table->string('overallstatus')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eval_pages');
    }
};

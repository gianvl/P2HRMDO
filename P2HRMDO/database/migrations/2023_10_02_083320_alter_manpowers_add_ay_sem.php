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
        Schema::table('manpowers', function (Blueprint $table) {
            $table->string('ay')->nullable()->after('department');
            $table->string('semester')->nullable()->after('ay');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('manpowers', function (Blueprint $table) {
            $table->dropColumn('ay');
            $table->dropColumn('semester');
        });
    }
};

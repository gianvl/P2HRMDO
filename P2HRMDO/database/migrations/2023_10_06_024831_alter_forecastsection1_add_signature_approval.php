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
        Schema::table('forecast_section1s', function (Blueprint $table) {
            $table->string('directorsignature')->nullable()->after('deansignature');
            $table->string('vpasignature')->nullable()->after('directorsignature');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('forecast_section1s', function (Blueprint $table) {
            $table->dropColumn('directorsignature');
            $table->dropColumn('vpasignature');
        });
    }
};

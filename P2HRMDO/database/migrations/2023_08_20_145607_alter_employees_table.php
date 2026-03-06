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
        Schema::table('employees', function (Blueprint $table) {
            $table->bigInteger('user_id')->after('id')->nullable()->unsigned();
            $table->foreign('user_id')->nullable()->constrained()->references('id')->on('users');
            $table->string('employment_status')->after('image');
            $table->string('hired_at')->nullable()->after('employment_status');
            $table->string('resigned_at')->nullable()->after('hired_at');
            $table->softDeletes($column = 'deleted_at', $precision = 0)->after('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->dropForeign('employees_user_id_foreign');
            $table->dropColumn('user_id');
            $table->dropColumn('employment_status');
            $table->dropColumn('hired_at');
            $table->dropColumn('resigned_at');
            $table->dropColumn('deleted_at');
        });
    }
};

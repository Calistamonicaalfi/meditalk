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
        Schema::table('calista_schedules', function (Blueprint $table) {
            $table->integer('kapasitas')->default(1)->after('jam_selesai');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('calista_schedules', function (Blueprint $table) {
            $table->dropColumn('kapasitas');
        });
    }
}; 
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
        Schema::table('calista_bookings', function (Blueprint $table) {
            // Drop the foreign key constraint first
            $table->dropForeign(['user_id']);
            
            // Make user_id nullable
            $table->foreignId('user_id')->nullable()->change();
            
            // Add foreign key constraint back but allow null
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('calista_bookings', function (Blueprint $table) {
            // Drop the foreign key constraint
            $table->dropForeign(['user_id']);
            
            // Make user_id not nullable again
            $table->foreignId('user_id')->nullable(false)->change();
            
            // Add foreign key constraint back
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
};

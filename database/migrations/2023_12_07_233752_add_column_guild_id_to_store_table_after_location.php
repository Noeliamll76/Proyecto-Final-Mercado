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
        Schema::table('store', function (Blueprint $table) {
            $table->unsignedBigInteger('guild_id');
            $table->foreign('guild_id')->references('id')->on('guild');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('store_table_after_location', function (Blueprint $table) {
            //
        });
    }
};

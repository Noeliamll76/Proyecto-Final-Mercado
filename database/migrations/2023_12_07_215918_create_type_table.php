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
        Schema::create('type', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('guild_id');
            $table->foreign('guild_id')->references('id')->on('guild');
            $table->string('description',255);
            $table->text('type_image',500);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('type');
    }
};

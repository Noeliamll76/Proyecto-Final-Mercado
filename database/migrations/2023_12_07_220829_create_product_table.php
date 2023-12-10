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
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('type_id');
            $table->foreign('type_id')->references('id')->on('type');
            // $table->unsignedBigInteger('store_id');
            // $table->foreign('store_id')->references('id')->on('store');
            $table->string('caliber',50);
            $table->string('variety',50);
            $table->string('origin',50);
            $table->float('price',5);
            $table->text('product_image',500);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};

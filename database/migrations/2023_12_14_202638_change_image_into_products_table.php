<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->unsignedBigInteger('image_id');
            $table->foreign('image_id')->references('id')->on('image_product');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

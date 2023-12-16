<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('image_product', function (Blueprint $table) {
            $table->id();
            $table->string('name_product',100);
            $table->string('variety',100);
            $table->text('image',500);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('image_product');
    }
};

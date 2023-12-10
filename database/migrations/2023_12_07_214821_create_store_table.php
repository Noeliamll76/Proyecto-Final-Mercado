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
        Schema::create('store', function (Blueprint $table) {
            $table->id();
            $table->string('store_name',100);
            $table->string('store_owner',100);
            $table->string('location',100);
            
            $table->boolean("is_active")->default(true);
            $table->text('store_image',500);
            $table->text('description',500);
            $table->string('email',100)->unique();
            $table->foreign('email')->references('email')->on('users');
            $table->string('password',10);
            $table->enum("roles",["admin"])->default("admin");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('store');
    }
};

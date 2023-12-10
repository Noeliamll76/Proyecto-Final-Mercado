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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name',100);
            $table->string('address',200);
            $table->integer('zip_code');
            $table->string('town',100);
            $table->string('phone',12);
            $table->string('DNI',10);
            $table->date('birthdate');
            $table->string('email',100)->unique();
            $table->string('password',10);
            $table->enum("roles",["user","admin","superadmin"])->default("user");
            $table->boolean("is_active")->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

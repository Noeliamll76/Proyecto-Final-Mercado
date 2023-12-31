<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class GuildsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('guilds')->insert(
            ['name' => 'Frutas y verduras',]
        );
        DB::table('guilds')->insert(
            ['name' => 'Droguería Perfumería',]
        );
        DB::table('guilds')->insert(
            ['name' => 'Menaje del hogar',]
        );
        DB::table('guilds')->insert(
            ['name' => 'Carnes y embutidos',]
        );
        DB::table('guilds')->insert(
            ['name' => 'Horno y Panadería',]
        );
        DB::table('guilds')->insert(
            ['name' => 'Salazones y ultramarinos',]
        );
        DB::table('guilds')->insert(
            ['name' => 'Pescadería',]
        );
        DB::table('guilds')->insert(
            ['name' => 'Frutos secos',]
        );
        DB::table('guilds')->insert(
            ['name' => 'Moda y textil',]
        );
        DB::table('guilds')->insert(
            ['name' => 'Floristería',]
        );
    }
}

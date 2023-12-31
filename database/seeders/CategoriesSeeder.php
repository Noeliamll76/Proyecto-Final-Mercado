<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert(
            [
                'guild_id' => '1',
                'name' => 'Frutas',
                'image'=> 'https://tse2.mm.bing.net/th?id=OIP.kvXfafC5KZu66DSPRQQoFAHaDg&pid=Api&P=0&h=180'
            ]
        );
        DB::table('categories')->insert(
            [
                'guild_id' => '1',
                'name' => 'Verduras y hortalizas',
                'image'=> 'https://tse1.mm.bing.net/th?id=OIP.WDyTNPoKCAFAgbVT-4dSagHaEb&pid=Api&P=0&h=180'
            ]
        );
        DB::table('categories')->insert(
            [
                'guild_id' => '2',
                'name' => 'Limpieza del hogar',
                'image'=> 'https://tse4.mm.bing.net/th?id=OIP.SAWiSTws8fGlS_VC3nG-LwHaEh&pid=Api&P=0&h=180'
            ]
        );
        DB::table('categories')->insert(
            [
                'guild_id' => '2',
                'name' => 'Higiene personal',
                'image'=> 'https://tse1.mm.bing.net/th?id=OIP.sDsf3qZ06NOkbTEwa7napwHaEB&pid=Api&P=0&h=180'
            ]
        );
        DB::table('categories')->insert(
            [
                'guild_id' => '3',
                'name' => 'Menaje de cocina',
                'image'=> 'https://tse4.mm.bing.net/th?id=OIP.Ag6A5NQ1wv6-zqxz4vnpqwAAAA&pid=Api&P=0&h=180'
            ]
        );
        DB::table('categories')->insert(
            [
                'guild_id' => '4',
                'name' => 'Carne de caballo',
                'image'=> 'https://biodog.es/wp-content/uploads/2013/05/carne-de-caballo-para-perros-BLNC.jpg'
            ]
        );
        DB::table('categories')->insert(
            [
                'guild_id' => '4',
                'name' => 'Carnes y embutidos',
                'image'=> 'https://tse2.mm.bing.net/th?id=OIP.TPk4Jn2ELDPk7wn3ldwa7wHaE7&pid=Api&P=0&h=180'
            ]
        );
        DB::table('categories')->insert(
            [
                'guild_id' => '5',
                'name' => 'Horno y panadería',
                'image'=> 'https://tse2.explicit.bing.net/th?id=OIP.CaOMDF8klludsvRb5CNS6QHaEh&pid=Api&P=0&h=180'
            ]
        );
        DB::table('categories')->insert(
            [
                'guild_id' => '6',
                'name' => 'Salazones y ultramarinos',
                'image'=> 'https://tse4.mm.bing.net/th?id=OIP.xx51JcL-z2hKXkQTphkQzAHaEK&pid=Api&P=0&h=180'
            ]
        );
        DB::table('categories')->insert(
            [
                'guild_id' => '7',
                'name' => 'Pescados y mariscos',
                'image'=> 'https://tse4.mm.bing.net/th?id=OIP.gSB_cvy1RpLRpUAzIWrp5AHaE7&pid=Api&P=0&h=180'
            ]
        );
        DB::table('categories')->insert(
            [
                'guild_id' => '8',
                'name' => 'Frutos secos',
                'image'=> 'https://tse2.mm.bing.net/th?id=OIP.SeSoPKZ4JUfq6sgUSxttzwHaEK&pid=Api&P=0&h=180'
            ]
        );
        DB::table('categories')->insert(
            [
                'guild_id' => '9',
                'name' => 'Moda y textil',
                'image'=> 'https://tse3.mm.bing.net/th?id=OIP.Uh_vDoc_S0c6bHk3TJq5wwHaFD&pid=Api&P=0&h=180'
            ]
        );
        DB::table('categories')->insert(
            [
                'guild_id' => '10',
                'name' => 'Floristería',
                'image'=> 'https://www.mobiliariocomercialedico.es/wp-content/uploads/2021/04/expositores-para-floristerias-1.jpg'
            ]
        );
    }
}

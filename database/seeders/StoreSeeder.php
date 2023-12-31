<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('stores')->insert(
            [
                'name' => 'Frutas y verduras Paco',
                'owner' => "Paco Martinez",
                'location' => 'Puestos 1-4 Nave 3',
                'guild_id' => '1',
                'is_active' => true,
                'image' => 'https://tse1.mm.bing.net/th?id=OIP.WDyTNPoKCAFAgbVT-4dSagHaEb&pid=Api&P=0&h=180',
                'description'=> 'Verduras de cosecha propia',
                'email' => 'paco@paco.com',
                'password' => Hash::make('password'),
                'roles' => "admin"
            ]
        );


        DB::table('stores')->insert(
            [
                'name' => 'Pescaderia Loli',
                'owner' => "Loli Panoli",
                'location' => 'Puestos 24-30 Nave 1',
                'guild_id' => '8',
                'is_active' => true,
                'image' => 'https://tse3.mm.bing.net/th?id=OIP.qNc322sGXXkDHVzmZBrjhgHaEv&pid=Api&P=0&h=180',
                'description'=> 'Pescados directos de la lonja',
                'email' => 'loli@loli.com',
                'password' => Hash::make('password'),
                'roles' => "admin"
            ]
        );

        DB::table('stores')->insert(
            [
                'name' => 'La huerta de Amparo',
                'owner' => "Amparo Blay",
                'location' => 'Puestos 6-8 Nave 3',
                'guild_id' => '1',
                'is_active' => true,
                'image' => 'https://tse2.mm.bing.net/th?id=OIP.7Rq5YHh_FV7T9Ults-gwmAHaE7&pid=Api&P=0&h=180',
                'description'=> 'Verduras de cosecha propia',
                'email' => 'amparo@amparo.com',
                'password' => Hash::make('password'),
                'roles' => "admin"
            ]
        );
        DB::table('stores')->insert(
            [
                'name' => 'La lonja groumet',
                'owner' => "Ricardo Mengol",
                'location' => 'Puestos 32-36 Nave 1',
                'guild_id' => '8',
                'is_active' => true,
                'image' => 'http://desdesoria.es/quemecomaeltigre/wp-content/uploads/2014/04/image30.jpg',
                'description'=> 'Productos seleccionados',
                'email' => 'ricardo@ricardo.com',
                'password' => Hash::make('password'),
                'roles' => "admin"
            ]
        );
        DB::table('stores')->insert(
            [
                'name' => 'Droguería Tere',
                'owner' => "Teresa Bosch",
                'location' => 'Exterior pta 10-12',
                'guild_id' => '2',
                'is_active' => true,
                'image' => 'https://comerciopetrer.es/wp-content/uploads/2021/02/droguer%C3%ADa-mari-4.jpg',
                'description'=> 'Todo lo necesario para tu hogar',
                'email' => 'teresa@teresa.com',
                'password' => Hash::make('password'),
                'roles' => "admin"
            ]
        );
    }
}

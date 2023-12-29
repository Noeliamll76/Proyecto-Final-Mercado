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
                'name' => Str::random(10),
                'owner'=> "Paco Martinez",
                'location' => 'Puestos 1-4 Nave 3',
                'guild_id' => '1',
                'is_active' => true,
                'image' => 'https://tse1.mm.bing.net/th?id=OIP.WDyTNPoKCAFAgbVT-4dSagHaEb&pid=Api&P=0&h=180',
                'email' => 'paco@paco.com',
                'password' => Hash::make('password'),
                'roles' => "admin"
            ]
        );

        DB::table('users')->insert(
            [
                'name' => Str::random(10),
                'owner'=> "Loli Panoli",
                'location' => 'Puestos 24-30 Nave 1',
                'guild_id' => '8',
                'is_active' => true,
                'image' => 'https://tse3.mm.bing.net/th?id=OIP.qNc322sGXXkDHVzmZBrjhgHaEv&pid=Api&P=0&h=180',
                'email' => 'loli@loli.com',
                'password' => Hash::make('password'),
                'roles' => "admin"
            ]
        );
       
        
    }
}

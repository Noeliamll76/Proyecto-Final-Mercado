<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert(
            [
                'name' => Str::random(10),
                'address' => 'Avd. Blasco Ibañez, 122, pta 7',
                'zip_code' => '46022',
                'town' => 'Valencia',
                'phone' => '666777888',
                'DNI' => '66777888L',
                'birthdate' => '2000/11/13',
                'email' => 'admin@admin.com',
                'password' => Hash::make('password'),
                'roles' => "admin"
            ]
        );

        DB::table('users')->insert(
            [
                'name' => Str::random(10),
                'address' => 'C/ Marino Sirera, 12, pta 17',
                'zip_code' => '46011',
                'town' => 'Valencia',
                'phone' => '600999888',
                'DNI' => '60099988L',
                'birthdate' => '1990/08/15',
                'email' => 'superadmin@superadmin.com',
                'password' => Hash::make('password'),
                'roles' => "superadmin"
            ]
        );

        DB::table('users')->insert(
            [
                'name' => Str::random(10),
                'address' => 'C/ Marino Sirera, 6, pta 21',
                'zip_code' => '46011',
                'town' => 'Valencia',
                'phone' => '600999888',
                'DNI' => '60099988L',
                'birthdate' => '1990/02/26',
                'email' => 'paco@paco.com',
                'password' => Hash::make('password'),
                'roles' => "user"
            ]
        );

        DB::table('users')->insert(
            [
                'name' => 'Loli',
                'address' => 'C/ Escalante, 12, bajo',
                'zip_code' => '46011',
                'town' => 'Valencia',
                'phone' => '600999888',
                'DNI' => '60099988L',
                'birthdate' => '1964/04/04',
                'email' => 'loli@loli.com',
                'password' => Hash::make('password'),
                'roles' => "user"
            ]
        );

        DB::table('users')->insert(
            [
                'name' => 'Manuela',
                'address' => 'C/ Rosario, 122, bajo',
                'zip_code' => '46011',
                'town' => 'Valencia',
                'phone' => '600999888',
                'DNI' => '60099988L',
                'birthdate' => '1964/07/19',
                'email' => 'manuela@manuela.com',
                'password' => Hash::make('password'),
                'roles' => "user"
            ]
        );
    }
}

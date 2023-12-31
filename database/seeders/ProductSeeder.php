<?php

namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert(
            [   
                'category_id' => '2',
                'store_id' => '1',
                'name' => 'berenjena',
                'variety'=> 'negra',
                'origin' => 'España',
                'price' => '2.90',
                'image_id' => '2',
            ]
        );
        DB::table('products')->insert(
            [   
                'category_id' => '2',
                'store_id' => '1',
                'name' => 'cebolla',
                'variety'=> 'morada',
                'origin' => 'España',
                'price' => '1.95',
                'image_id' => '7',
            ]
        );
        DB::table('products')->insert(
            [   
                'category_id' => '2',
                'store_id' => '1',
                'name' => 'lechuga',
                'variety'=> 'romana',
                'origin' => 'España',
                'price' => '0.95',
                'image_id' => '1',
            ]
        );
        DB::table('products')->insert(
            [   
                'category_id' => '1',
                'store_id' => '3',
                'name' => 'aguacate',
                'variety'=> 'Hass',
                'origin' => 'Valencia',
                'price' => '5.90',
                'image_id' => '11',
            ]
        );
        DB::table('products')->insert(
            [   
                'category_id' => '2',
                'store_id' => '3',
                'name' => 'calabacin',
                'variety'=> 'verde',
                'origin' => 'Valencia',
                'price' => '4.50',
                'image_id' => '3',
            ]
        );
        DB::table('products')->insert(
            [   
                'category_id' => '2',
                'store_id' => '3',
                'name' => 'cebolla',
                'variety'=> 'blanca o dulce',
                'origin' => 'Valencia',
                'price' => '2.50',
                'image_id' => '8',
            ]
        );
        DB::table('products')->insert(
            [   
                'category_id' => '7',
                'store_id' => '2',
                'name' => 'salmon',
                'variety'=> 'noruego',
                'origin' => 'Noruega',
                'price' => '25.00',
                'image_id' => '10',
            ]
        );
        DB::table('products')->insert(
            [   
                'category_id' => '7',
                'store_id' => '2',
                'name' => 'salmonete',
                'variety'=> 'rojo',
                'origin' => 'Castellon',
                'price' => '30.00',
                'image_id' => '11',
            ]
        );
        DB::table('products')->insert(
            [   
                'category_id' => '7',
                'store_id' => '2',
                'name' => 'merluza',
                'variety'=> 'de pincho',
                'origin' => 'Atlantico',
                'price' => '22.00',
                'image_id' => '1',
            ]
        );
        DB::table('products')->insert(
            [   
                'category_id' => '7',
                'store_id' => '4',
                'name' => 'salmon',
                'variety'=> 'noruego',
                'origin' => 'Noruega',
                'price' => '24.50',
                'image_id' => '10',
            ]
        );
        DB::table('products')->insert(
            [   
                'category_id' => '7',
                'store_id' => '4',
                'name' => 'sardina',
                'variety'=> 'comun',
                'origin' => 'Atlantico',
                'price' => '9.50',
                'image_id' => '1',
            ]
        );
        DB::table('products')->insert(
            [   
                'category_id' => '7',
                'store_id' => '4',
                'name' => 'gamba',
                'variety'=> 'rayada',
                'origin' => 'Denia',
                'price' => '75.50',
                'image_id' => '1',
            ]
        );
        DB::table('products')->insert(
            [   
                'category_id' => '3',
                'store_id' => '5',
                'name' => 'lejia',
                'variety'=> 'EL CHE',
                'origin' => 'valencia',
                'price' => '2.50',
                'image_id' => '13',
            ]
        );
    }
}

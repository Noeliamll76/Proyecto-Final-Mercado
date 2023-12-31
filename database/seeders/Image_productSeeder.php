<?php

namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class Image_productSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('image_product')->insert(
            [   
                'name_product' => 'sin foto',
                'variety' => 'sin foto',
                'image' => 'https://tse4.mm.bing.net/th?id=OIP.DYQW0VqDgpPKvY4T-RqtrAHaGo&pid=Api&P=0&h=180',
     
            ]
        );
        DB::table('image_product')->insert(
            [   
                'name_product' => 'berenjena',
                'variety' => 'negra',
                'image' => 'https://tse4.mm.bing.net/th?id=OIP.zmooLXOPZ82hR_16-1uSLAHaHa&pid=Api&P=0&h=180',
     
            ]
        );
        DB::table('image_product')->insert(
            [   
                'name_product' => 'calabacin',
                'variety' => 'verde',
                'image' => 'https://tse4.mm.bing.net/th?id=OIP.zmooLXOPZ82hR_16-1uSLAHaHa&pid=Api&P=0&h=180',
     
            ]
        );
        DB::table('image_product')->insert(
            [   
                'name_product' => 'calabacin',
                'variety' => 'blanco',
                'image' => 'https://tse4.mm.bing.net/th?id=OIP.zmooLXOPZ82hR_16-1uSLAHaHa&pid=Api&P=0&h=180',
     
            ]
        );
        DB::table('image_product')->insert(
            [   
                'name_product' => 'cebolla',
                'variety' => 'tierna',
                'image' => 'https://tse2.mm.bing.net/th?id=OIP.vcoHqlbimjQ5qYdOttgv5AAAAA&pid=Api&P=0&h=180',
     
            ]
        );
        DB::table('image_product')->insert(
            [   
                'name_product' => 'cebolla',
                'variety' => 'morada',
                'image' => 'https://tse2.mm.bing.net/th?id=OIP.rKI1zc0P7lVYp6sWYFMRgQHaEm&pid=Api&P=0&h=180',
     
            ]
        );
        DB::table('image_product')->insert(
            [   
                'name_product' => 'cebolla',
                'variety' => 'blanca o dulce',
                'image' => 'https://tse2.explicit.bing.net/th?id=OIP.2GcXQ_XMeHKVWNIy-KG0PQHaEc&pid=Api&P=0&h=180',
     
            ]
        );
        DB::table('image_product')->insert(
            [   
                'name_product' => 'cebolla',
                'variety' => 'terreno',
                'image' => 'https://tse4.mm.bing.net/th?id=OIP.IML-DeGrsDeQsuwT9CZZPwHaFB&pid=Api&P=0&h=180',
     
            ]
        );
        DB::table('image_product')->insert(
            [   
                'name_product' => 'salmon',
                'variety' => 'noruego',
                'image' => 'https://tse2.mm.bing.net/th?id=OIP.LzW9enKw4gsS0vjlNkXwGwHaFj&pid=Api&P=0&h=180',
     
            ]
        );
        DB::table('image_product')->insert(
            [   
                'name_product' => 'salmonete',
                'variety' => 'rojo',
                'image' => 'https://tse1.mm.bing.net/th?id=OIP.PnF0fCd4nfNZPWYRu90b1AHaFj&pid=Api&P=0&h=180',
     
            ]
        );
        DB::table('image_product')->insert(
            [   
                'name_product' => 'sardina',
                'variety' => 'comun',
                'image' => 'https://tse2.mm.bing.net/th?id=OIP.4jPIw7RXe_xQLAS2bLxZBwHaE8&pid=Api&P=0&h=180',
     
            ]
        );
        DB::table('image_product')->insert(
            [   
                'name_product' => 'gamba',
                'variety' => 'rayada',
                'image' => 'https://tse1.mm.bing.net/th?id=OIP.sT1maCUaq2kvoxkiIe-P_wHaE7&pid=Api&P=0&h=180',
     
            ]
        );
        DB::table('image_product')->insert(
            [   
                'name_product' => 'lejia',
                'variety' => 'EL CHE',
                'image' => 'https://cdn.pymesenlared.es/img/291/3752/65212/lejia-normal-2l.jpg',
     
            ]
        );
        DB::table('image_product')->insert(
            [   
                'name_product' => 'detergente ORO',
                'variety' => 'marsella',
                'image' => 'https://productosdelimpiezayservicios.es/845-large_default/detergente-marsella-oro-5-litros.jpg',
     
            ]
        );
        DB::table('image_product')->insert(
            [   
                'name_product' => 'pan barra',
                'variety' => '250 grs',
                'image' => 'https://tse4.mm.bing.net/th?id=OIP.rDcKyiXwAo6Z60BnOSW-JgHaFj&pid=Api&P=0&h=180',
     
            ]
        );
        DB::table('image_product')->insert(
            [   
                'name_product' => 'lechuga',
                'variety' => 'romana',
                'image' => 'https://tse3.mm.bing.net/th?id=OIP.GxRzNUZb-TwPRWhSij7VkAHaE4&pid=Api&P=0&h=180',
     
            ]
        );
        DB::table('image_product')->insert(
            [   
                'name_product' => 'aguacate',
                'variety' => 'Hass',
                'image' => 'https://tse1.mm.bing.net/th?id=OIP.gsIq4xozqaFIxldgdANqJQHaEz&pid=Api&P=0&h=180',
     
            ]
        );
        DB::table('image_product')->insert(
            [   
                'name_product' => 'merluza',
                'variety' => 'pincho',
                'image' => 'https://tse3.explicit.bing.net/th?id=OIP.z_0Vs1ll6BXo7g52rFRtJQHaEj&pid=Api&P=0&h=180',
     
            ]
        );
    }
}

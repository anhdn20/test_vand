<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                'name' => 'Áo 1',
                'price' => 153000,
                'quantity' => 4,
                'store_id' =>  1,
            ],
            [

                'name' => 'Áo 2',
                'price' => 523000,
                'quantity' => 4,
                'store_id' =>  1,
            ],
            [

                'name' => 'Dép',
                'price' => 123000,
                'quantity' => 4,
                'store_id' =>  1,
            ],
            [

                'name' => 'Mũ',
                'price' => 623000,
                'quantity' => 4,
                'store_id' =>  1,
            ],
            [
                'name' => 'Dép',
                'price' => 323000,
                'quantity' => 4,
                'store_id' =>  2,
            ],
            [

                'name' => 'Túi',
                'price' => 129000,
                'quantity' => 4,
                'store_id' =>  2,
            ]
        ]);
    }
}

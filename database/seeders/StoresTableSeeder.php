<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StoresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('stores')->insert([
            [
                'name' => 'Cửa hàng hàng 1',
                'address' => 'Phường 5, Gò Vấp',
                'user_id' =>  1,
            ],
            [

                'name' => 'Cửa hàng hàng 2',
                'address' => 'Phường 7, Gò Vấp',
                'user_id' =>  1,
            ],
            [

                'name' => 'Cửa hàng hàng 3',
                'address' => '23 Lê Văn Duyệt, Bình Thạnh',
                'user_id' =>  2,
            ],
            [

                'name' => 'Cửa hàng hàng 4',
                'address' => '678 Lê Văn Duyệt, Bình Thạnh',
                'user_id' =>  2,
            ]
        ]);
    }
}

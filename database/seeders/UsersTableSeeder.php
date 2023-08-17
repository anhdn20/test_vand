<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'anhdn20',
                'email' => 'anhdn20@gmail.com',
                'password' =>  bcrypt(123),
            ],
            [

                'name' => 'vand',
                'email' => 'vand@gmail.com',
                'password' =>  bcrypt(123),
            ]
        ]);

    }
}

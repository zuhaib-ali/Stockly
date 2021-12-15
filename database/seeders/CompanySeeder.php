<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('companies')->insert([
            'name' => 'HP',
            'email' => 'hp@gmail.com',
            'address' => 'Palo Alto, California',
            'phone' => '01111111111',
        ]);

        DB::table('companies')->insert([
            'name' => 'Dell',
            'email' => 'dell@gmail.com',
            'address' => '1 Dell Way, Round Rock, TX 78664',
            'phone' => '02222222222',
        ]);

        DB::table('companies')->insert([
            'name' => 'Honda',
            'email' => 'honda@gmail.com',
            'address' => 'Torrance, California',
            'phone' => '03333333333',
        ]);

        DB::table('companies')->insert([
            'name' => 'Nike',
            'email' => 'nike@gmail.com',
            'address' => 'Beaverton, OR',
            'phone' => '04444444444',
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class InvestorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('investers')->insert([
            'first_name' => 'investor',
            'last_name' => '1',
            'username' => 'investor 1',
            'email' => 'investor1@email.com',
            'phone' => '01111111111',
            'password' => Hash::make(123),
            'address' => 'address 1',
            'cnic' => '4320111111111',
            'cnic_front' => 'front.jpg',
            'cnic_back' => 'back.jpg',
            'terms_conditions' => true,
            'accountant_id' => 1,
            'level' => 1,
            'referral_code' => 1,
        ]);

        DB::table('investers')->insert([
            'first_name' => 'investor',
            'last_name' => '2',
            'username' => 'investor 2',
            'email' => 'investor2@email.com',
            'phone' => '02222222222',
            'password' => Hash::make(123),
            'address' => 'address 2',
            'cnic' => '4320211111111',
            'cnic_front' => 'front.jpg',
            'cnic_back' => 'back.jpg',
            'terms_conditions' => true,
            'accountant_id' => 1,
            'level' => 1,
            'referral_code' => 2,
        ]);

        DB::table('investers')->insert([
            'first_name' => 'investor',
            'last_name' => '3',
            'username' => 'investor 3',
            'email' => 'investor3@email.com',
            'phone' => '03333333333',
            'password' => Hash::make(123),
            'address' => 'address 3',
            'cnic' => '4320311111111',
            'cnic_front' => 'front.jpg',
            'cnic_back' => 'back.jpg',
            'terms_conditions' => true,
            'accountant_id' => 1,
            'level' => 1,
            'referral_code' => 3,
        ]);
    }
}

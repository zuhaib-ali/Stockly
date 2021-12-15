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
            'first_name' => 'amir',
            'last_name' => 'ali',
            'username' => 'amir ali',
            'email' => 'amirali@email.com',
            'phone' => '01111111111',
            'password' => Hash::make(123),
            'address' => 'address 1',
            'cnic' => '4320111111111',
            'cnic_front' => 'front.jpg',
            'cnic_back' => 'back.jpg',
            'terms_conditions' => true,
            'accountant_id' => 1,
        ]);

        DB::table('investers')->insert([
            'first_name' => 'irfan',
            'last_name' => 'ali',
            'username' => 'irfan ali',
            'email' => 'irfanali@email.com',
            'phone' => '02222222222',
            'password' => Hash::make(123),
            'address' => 'address 2',
            'cnic' => '4320111111112',
            'cnic_front' => 'front2.jpg',
            'cnic_back' => 'back2.jpg',
            'terms_conditions' => true,
            'accountant_id' => 1,
            'referral_code' => 1
        ]);

        DB::table('investers')->insert([
            'first_name' => 'imran',
            'last_name' => 'ali',
            'username' => 'imran ali',
            'email' => 'imranali@email.com',
            'phone' => '03333333333',
            'password' => Hash::make(123),
            'address' => 'address 3',
            'cnic' => '4320111111113',
            'cnic_front' => 'front3.jpg',
            'cnic_back' => 'back3.jpg',
            'terms_conditions' => true,
            'accountant_id' => 1,
            'referral_code' => 2
        ]);

        DB::table('investers')->insert([
            'first_name' => 'iqrar',
            'last_name' => 'ali',
            'username' => 'iqrar ali',
            'email' => 'iqrarali@email.com',
            'phone' => '04444444444',
            'password' => Hash::make(123),
            'address' => 'address 2',
            'cnic' => '4320111111114',
            'cnic_front' => 'front4.jpg',
            'cnic_back' => 'back4.jpg',
            'terms_conditions' => true,
            'accountant_id' => 1,
        ]);
    }
}

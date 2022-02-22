<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'employee_id' => 'Samin',
            'name' => 'Samin Yeasar',
            'phone' => '01731509208',
            'address' => 'Shaymoli',
            'designation_id' => 1,
            'password' => Hash::make('1212'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('users')->insert([
            'employee_id' => 'admin',
            'name' => 'Admin',
            'phone' => '01700000000',
            'address' => 'Root',
            'designation_id' => 1,
            'password' => Hash::make('1212'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AgentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('agents')->insert([
            'email' => 'maheer25@gmail.com',
            'full_name' => 'Mr.Maheer Bu-Areesh',            
            'phone' => '00966555966404',            
            'photo' => 'storage/agent/agent_photo_4_1644919852_1644919852.jpg',            
            'updated_by' => 0,            
            'password' => 'maheer',            
            'opening_balance' => 0,            
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}

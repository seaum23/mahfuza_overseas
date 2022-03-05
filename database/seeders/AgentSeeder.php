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
            'designation' => 'maheer25@gmail.com',
            'parent_id' => '',            
            'parent_id' => 'a',            
            'parent_id' => 'a',            
            'parent_id' => 'a',            
            'parent_id' => 'a',            
            'parent_id' => 'a',            
            'parent_id' => 'a',            
            'parent_id' => 'a',            
            'parent_id' => 'a',            
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name' => 'nav candidate']);
        Permission::create(['name' => 'nav visa']);
        Permission::create(['name' => 'nav ticket']);
        Permission::create(['name' => 'nav agent']);
        Permission::create(['name' => 'nav delegate']);
        Permission::create(['name' => 'nav sponsor']);
        Permission::create(['name' => 'nav manpower']);
        Permission::create(['name' => 'nav jobs']);
        Permission::create(['name' => 'nav hrm']);
        Permission::create(['name' => 'nav role-permission']);
        Permission::create(['name' => 'nav accounts']);
        Permission::create(['name' => 'nav webiste fornatpage']);
        Permission::create(['name' => 'nav packages']);
    }
}

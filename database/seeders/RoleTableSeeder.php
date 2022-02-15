<?php

namespace Database\Seeders;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'superadmin',
            'guard_name' => 'web'
        ]);
        Role::create([
            'name' => 'admin',
            'guard_name' => 'web'
        ]);
        Role::create([
            'name' => 'host',
            'guard_name' => 'web'
        ]);
        Role::create([
            'name' => 'guest',
            'guard_name' => 'web'
        ]);
    }
}

<?php

namespace Database\Seeders;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create([
            'name' => 'list-users',
            'guard_name' => 'web'
        ]);
        Permission::create([
            'name' => 'add-user',
            'guard_name' => 'web'
        ]);
        Permission::create([
            'name' => 'show-user',
            'guard_name' => 'web'
        ]);
        Permission::create([
            'name' => 'edit-user',
            'guard_name' => 'web'
        ]);
        Permission::create([
            'name' => 'delete-user',
            'guard_name' => 'web'
        ]);
        Permission::create([
            'name' => 'list-permissions',
            'guard_name' => 'web'
        ]);
        Permission::create([
            'name' => 'add-permission',
            'guard_name' => 'web'
        ]);
        Permission::create([
            'name' => 'show-permission',
            'guard_name' => 'web'
        ]);
        Permission::create([
            'name' => 'edit-permission',
            'guard_name' => 'web'
        ]);
        Permission::create([
            'name' => 'delete-permission',
            'guard_name' => 'web'
        ]);
        Permission::create([
            'name' => 'list-roles',
            'guard_name' => 'web'
        ]);
        Permission::create([
            'name' => 'add-role',
            'guard_name' => 'web'
        ]);
        Permission::create([
            'name' => 'show-role',
            'guard_name' => 'web'
        ]);
        Permission::create([
            'name' => 'edit-role',
            'guard_name' => 'web'
        ]);
        Permission::create([
            'name' => 'delete-role',
            'guard_name' => 'web'
        ]);
        Permission::create([
            'name' => 'list-invitations',
            'guard_name' => 'web'
        ]);
        Permission::create([
            'name' => 'add-invitation',
            'guard_name' => 'web'
        ]);
        Permission::create([
            'name' => 'find-invitation',
            'guard_name' => 'web'
        ]);
        Permission::create([
            'name' => 'show-invitation',
            'guard_name' => 'web'
        ]);
        Permission::create([
            'name' => 'edit-invitation',
            'guard_name' => 'web'
        ]);
        Permission::create([
            'name' => 'delete-invitation',
            'guard_name' => 'web'
        ]);
        Permission::create([
            'name' => 'active-invitation',
            'guard_name' => 'web'
        ]);
        Permission::create([
            'name' => 'my-invitations',
            'guard_name' => 'web'
        ]);
        Permission::create([
            'name' => 'active-guest',
            'guard_name' => 'web'
        ]);
        Permission::create([
            'name' => 'close-invitation',
            'guard_name' => 'web'
        ]);
        Permission::create([
            'name' => 'list-payments',
            'guard_name' => 'web'
        ]);
        Permission::create([
            'name' => 'my-subscriptions',
            'guard_name' => 'web'
        ]);        
        Permission::create([
            'name' => 'my-payments',
            'guard_name' => 'web'
        ]);
        Permission::create([
            'name' => 'my-income',
            'guard_name' => 'web'
        ]);
        Permission::create([
            'name' => 'set-bonus',
            'guard_name' => 'web'
        ]);
        Permission::create([
            'name' => 'see-gauge',
            'guard_name' => 'web'
        ]);
    }
}

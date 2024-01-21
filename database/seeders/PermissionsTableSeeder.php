<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $permissions = ['create', 'read', 'update', 'delete'];

         foreach ($permissions as $permission) {
             Permission::create(['name' => $permission]);
         }
         $adminRole = Role::create(['name' => 'admin']);
         $userRole = Role::create(['name' => 'user']);
         $adminRole->givePermissionTo($permissions);
         $userRole->givePermissionTo('read');
    }
}

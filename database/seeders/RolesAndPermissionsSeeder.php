<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions with 'api' guard
        $createPosts = Permission::firstOrCreate([
            'name' => 'create posts',
            'guard_name' => 'api',
        ]);

        $editPosts = Permission::firstOrCreate([
            'name' => 'edit posts',
            'guard_name' => 'api',
        ]);

        // Create roles with 'api' guard
        $admin = Role::firstOrCreate([
            'name' => 'admin',
            'guard_name' => 'api',
        ]);

        $user = Role::firstOrCreate([
            'name' => 'user',
            'guard_name' => 'api',
        ]);

        // Assign permissions
        $admin->givePermissionTo([$createPosts, $editPosts]);
        $user->givePermissionTo($createPosts);
    }
}

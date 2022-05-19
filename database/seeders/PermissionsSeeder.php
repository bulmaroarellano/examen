<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create default permissions
        Permission::create(['name' => 'list allacciones']);
        Permission::create(['name' => 'view allacciones']);
        Permission::create(['name' => 'create allacciones']);
        Permission::create(['name' => 'update allacciones']);
        Permission::create(['name' => 'delete allacciones']);

        Permission::create(['name' => 'list bitacoras']);
        Permission::create(['name' => 'view bitacoras']);
        Permission::create(['name' => 'create bitacoras']);
        Permission::create(['name' => 'update bitacoras']);
        Permission::create(['name' => 'delete bitacoras']);

        Permission::create(['name' => 'list allexamenes']);
        Permission::create(['name' => 'view allexamenes']);
        Permission::create(['name' => 'create allexamenes']);
        Permission::create(['name' => 'update allexamenes']);
        Permission::create(['name' => 'delete allexamenes']);

        Permission::create(['name' => 'list allpreguntas']);
        Permission::create(['name' => 'view allpreguntas']);
        Permission::create(['name' => 'create allpreguntas']);
        Permission::create(['name' => 'update allpreguntas']);
        Permission::create(['name' => 'delete allpreguntas']);

        Permission::create(['name' => 'list allrespuestas']);
        Permission::create(['name' => 'view allrespuestas']);
        Permission::create(['name' => 'create allrespuestas']);
        Permission::create(['name' => 'update allrespuestas']);
        Permission::create(['name' => 'delete allrespuestas']);

        // Create user role and assign existing permissions
        $currentPermissions = Permission::all();
        $userRole = Role::create(['name' => 'user']);
        $userRole->givePermissionTo($currentPermissions);

        // Create admin exclusive permissions
        Permission::create(['name' => 'list roles']);
        Permission::create(['name' => 'view roles']);
        Permission::create(['name' => 'create roles']);
        Permission::create(['name' => 'update roles']);
        Permission::create(['name' => 'delete roles']);

        Permission::create(['name' => 'list permissions']);
        Permission::create(['name' => 'view permissions']);
        Permission::create(['name' => 'create permissions']);
        Permission::create(['name' => 'update permissions']);
        Permission::create(['name' => 'delete permissions']);

        Permission::create(['name' => 'list users']);
        Permission::create(['name' => 'view users']);
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'update users']);
        Permission::create(['name' => 'delete users']);

        // Create admin role and assign all permissions
        $allPermissions = Permission::all();
        $adminRole = Role::create(['name' => 'super-admin']);
        $adminRole->givePermissionTo($allPermissions);

        $user = \App\Models\User::whereEmail('admin@admin.com')->first();

        if ($user) {
            $user->assignRole($adminRole);
        }
    }
}

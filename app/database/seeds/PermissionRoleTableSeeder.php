<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class PermissionRoleTableSeeder extends Seeder {

    public function run()
    {
        $admin = Role::where('name', 'Admin')->firstOrFail();

        $manageUsers = Permission::where('name', 'manage_users')->firstOrFail();
        $viewAdmin = Permission::where('name', 'view_admin')->firstOrFail();
        $managePerms = Permission::where('name', 'manage_permissions')->firstOrFail();
        $manageRoles = Permission::where('name', 'manage_roles')->firstOrFail();

        $admin->perms()->sync([
            $manageUsers->id,
            $manageRoles->id,
            $managePerms->id,
            $viewAdmin->id,
        ]);
    }

}
<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class PermissionsTableSeeder extends Seeder {

    public function run()
    {
        Eloquent::unguard();
        Permission::create([
            'name'  => 'view_admin',
            'display_name'  => 'View the Admin Area'
        ]);
        Permission::create([
            'name'  => 'manage_users',
            'display_name'  => 'Manage Users'
        ]);
        Permission::create([
            'name'  => 'manage_permissions',
            'display_name'  => 'Create and Manage Permissions'
        ]);
        Permission::create([
            'name'  => 'manage_roles',
            'display_name'  => 'Create and Manage Roles'
        ]);
        Permission::create([
            'name'  => 'manage_playbook_meta',
            'display_name'  => 'Manage Meta Categories for the Playbook'
        ]);
        Permission::create([
            'name'  => 'manage_playbook',
            'display_name'  => 'Manage Playbook Data'
        ]);
        Permission::create([
            'name'  => 'manage_kickoffs',
            'display_name'  => 'Manage Sales Kickoff Sites'
        ]);
        Permission::create([
            'name'  => 'upload_files',
            'display_name'  => 'Upload New Files'
        ]);
    }

}

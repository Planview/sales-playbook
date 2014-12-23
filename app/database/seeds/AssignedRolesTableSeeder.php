<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class AssignedRolesTableSeeder extends Seeder {

    public function run()
    {
        $user = Confide::getUserByEmailOrUsername(['username' => 'pvadmin']);

        $adminRole = Role::where('name', 'Admin')->firstOrFail();

        $user->attachRole($adminRole);
    }

}

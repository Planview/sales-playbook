<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class RolesTableSeeder extends Seeder {

    public function run()
    {
        Eloquent::unguard();

        Role::create([
            'name'  => 'Admin'
        ]);
    }

}

<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder {

    public function run()
    {
        $admin = User::create([
            'username'  => 'pvadmin',
            'email'     => 'webmaster@planview.com',
            'password'  => 'password',
            'password_confirmation' => 'password',
            'confirmation_code'     => md5(uniqid(mt_rand(), true))
        ]);

        $admin->confirm();

        $faker = Faker::create();

        foreach(range(1, 10) as $index)
        {
            $password = $faker->password;

            User::create([
                'username'  => $faker->userName,
                'email'     => $faker->email,
                'password'  => $password,
                'password_confirmation' => $password,
                'confirmation_code'     => md5(uniqid(mt_rand(), true))
            ]);
        }
    }

}

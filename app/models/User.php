<?php

use Zizaco\Confide\ConfideUser;
use Zizaco\Confide\ConfideUserInterface;
use Zizaco\Entrust\HasRole;
use Faker\Factory as Faker;

class User extends Eloquent implements ConfideUserInterface
{

    use ConfideUser, HasRole;

    /**
     * Create a simple array of the user's roles by id
     */
    public function rolesById()
    {
        $roles = array();

        foreach ($this->roles as $role) {
            $roles[] = $role->id;
        }

        return $roles;
    }

    public function autoGeneratePassword()
    {
        $faker = Faker::create();

        $password = $faker->password;

        $this->password = $password;
        $this->password_confirmation = $password;

        return $password;
    }

}

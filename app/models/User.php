<?php

use Zizaco\Confide\ConfideUser;
use Zizaco\Confide\ConfideUserInterface;
use Zizaco\Entrust\HasRole;

class User extends Eloquent implements ConfideUserInterface
{

    use ConfideUser, HasRole;

    /**
     * Create a simple array of the user's roles by id
     */
    public function rolesById() {
        $roles = array();

        foreach ($this->roles as $role) {
            $roles[] = $role->id;
        }

        return $roles;
    }

}

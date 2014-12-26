<?php

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{

    public static function optionsList()
    {
        $list = array();

        foreach (self::all() as $role) {
            $list[$role->id] = $role->name;
        }

        return $list;
    }

}

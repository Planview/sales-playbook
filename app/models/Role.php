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

    /**
     * Get all permissions by id that are associated to a given role
     * @return array Array of id's for a role's permissions
     */
    public function permissionsById()
    {
        $permissionsById = array();

        foreach ($this->perms as $permission) {
            $permissionsById[] = $permission->id;
        }

        return $permissionsById;
    }

}

<?php

use Zizaco\Entrust\EntrustPermission;

class Permission extends EntrustPermission
{

    /**
     * Generate a list of all permissions for use in a select
     * @return  array   All permissions in id => display_name form
     */
    public static function optionsList()
    {
        $options = array();

        foreach (self::all() as $permission) {
            $options[$permission->id] = $permission->display_name;
        }

        return $options;
    }

}

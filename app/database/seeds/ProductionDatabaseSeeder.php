<?php

class ProductionDatabaseSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();

        $this->call('UsersTableSeeder');
        $this->call('PermissionsTableSeeder');
        $this->call('RolesTableSeeder');
        $this->call('PermissionRoleTableSeeder');
        $this->call('AssignedRolesTableSeeder');
    }

}

<?php

class DatabaseSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();

        $this->call('PlanviewRegionsTableSeeder');
        $this->call('PlanviewSubRegionsTableSeeder');
        $this->call('OperatingRegionsTableSeeder');
        $this->call('IndustriesTableSeeder');
        $this->call('MarketsTableSeeder');
        $this->call('CompetitorsTableSeeder');
        $this->call('CustomersTableSeeder');
        $this->call('DocumentTypesTableSeeder');
        $this->call('DocumentsTableSeeder');
        $this->call('UsersTableSeeder');
    }

}

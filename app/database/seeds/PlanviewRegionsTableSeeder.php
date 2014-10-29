<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class PlanviewRegionsTableSeeder extends Seeder {

	public function run()
	{
        PlanviewRegion::create(['name' => 'North America']);
        PlanviewRegion::create(['name' => 'EMEA']);
        PlanviewRegion::create(['name' => 'APAC']);
		PlanviewRegion::create(['name' => 'South America']);
	}

}

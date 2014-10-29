<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class PlanviewSubRegionsTableSeeder extends Seeder {

	public function run()
	{

        $region = PlanviewRegion::find(1);

		$faker = Faker::create();

		foreach(range(1, 5) as $index)
		{
			$subRegion = new PlanviewSubRegion([
                'name' => $faker->state
			]);

            $subRegion->planviewRegion()->associate($region);

            $subRegion->save();
		}

        foreach(range(1, 5) as $index) {
            $region = PlanviewRegion::find($index % 3 + 2);

            $subRegion = new PlanviewSubRegion([
                'name' => $faker->country
            ]);

            $subRegion->planviewRegion()->associate($region);

            $subRegion->save();
        }
	}

}

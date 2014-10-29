<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class CustomersTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 10) as $index)
		{
			$customer = new Customer([
                'name' => $faker->company,
                'can_use_name' => $faker->boolean(30)
			]);

            $planviewSubRegion = PlanviewSubRegion::find($faker->randomDigit + 1);
            $industry = Industry::find($faker->randomDigit + 1);
            $operatingRegion = OperatingRegion::find($faker->randomDigit + 1);
            $customer->planviewSubRegion()->associate($planviewSubRegion);
            $customer->industry()->associate($industry);
            $customer->operatingRegion()->associate($operatingRegion);
            $customer->save();

            foreach (range(1, 2) as $subIndex) {
                $customer->markets()->attach(1 + $faker->randomDigit % 5);
                $customer->competitors()->attach(1 + $faker->randomDigit);
            }
		}
	}

}

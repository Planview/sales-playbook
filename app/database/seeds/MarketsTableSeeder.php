<?php

class MarketsTableSeeder extends Seeder {

	public function run()
	{
        Market::create(['name' => 'IT']);
        Market::create(['name' => 'PD']);
        Market::create(['name' => 'SRP']);
        Market::create(['name' => 'CFP']);
		Market::create(['name' => 'CloudLift']);
	}

}

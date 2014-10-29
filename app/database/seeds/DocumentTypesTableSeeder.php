<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class DocumentTypesTableSeeder extends Seeder {

	public function run()
	{
        DocumentType::create(['name' => 'Win Announcement', 'internal_only' => true]);
        DocumentType::create(['name' => 'CVP', 'internal_only' => true]);
        DocumentType::create(['name' => 'Go-Live Announcement', 'internal_only' => true]);
        DocumentType::create(['name' => 'Case Study', 'internal_only' => false]);
        DocumentType::create(['name' => 'Case Study Slide', 'internal_only' => false]);
	}

}

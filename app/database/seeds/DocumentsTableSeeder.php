<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class DocumentsTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 10) as $index)
		{
            $document = new Document([
                'title' => $faker->bs,
                'url' => $faker->url
            ]);
            $document->documentType()->associate(DocumentType::find(1 + $faker->randomDigit % 5));
			$customer = Customer::find($faker->randomDigit + 1);
            $customer->documents()->save($document);
		}
	}

}

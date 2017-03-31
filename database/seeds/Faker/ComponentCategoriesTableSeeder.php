<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

use Sirce\Models\ComponentCategory;

class ComponentCategoriesTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$faker = Faker::create();

		$root = ComponentCategory::create([
			'category' => $faker->unique()->word
		]);

		$categories = [$root];

		foreach (range(1, 50) as $index) {
			$child = ComponentCategory::create([
				'category' => $faker->unique()->word
			]);
			$child->makeChildOf($categories[array_rand($categories)]);

			$categories[] = $child;
		}
    }

}
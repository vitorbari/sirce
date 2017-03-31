<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

use Sirce\Models\Component;
use Sirce\Models\ComponentCategory;

class ComponentsTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $componentCategoriesIds = ComponentCategory::lists('id');

        foreach (range(1, 200) as $index) {
            Component::create([
                'component_category_id' => $faker->randomElement($componentCategoriesIds),
                'component'             => $faker->word
            ]);
        }
    }

}
<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

use Sirce\Models\Component;
use Sirce\Models\Language;
use Sirce\Models\Reference;
use Sirce\Models\User;

class ReferencesTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $usersIds = User::lists('id');
        $componentsIds = Component::lists('id');
        $languagesIds = Language::lists('id');

        foreach (range(1, 200) as $index) {
            $reference = Reference::create([
                'user_id'      => $faker->randomElement($usersIds),
                'component_id' => $faker->randomElement($componentsIds),
                'language_id'  => $faker->randomElement($languagesIds),
                'published_at' => $faker->optional()->unixTime(),
                'views'        => $faker->numberBetween(0, 300),
                'title'        => $faker->sentence,
                'markdown'     => $faker->text
            ]);

			$reference->boards()->sync([1, 2, 3]);
        }
    }

}
<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Sirce\Models\Manufacturer;

class ManufacturersTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 10) as $index) {
            Manufacturer::create([
                'manufacturer' => $faker->unique()->name,
                'description'  => $faker->text,
                'website'      => $faker->url
            ]);
        }
    }

}
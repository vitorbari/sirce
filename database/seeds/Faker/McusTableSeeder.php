<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

use Sirce\Models\Manufacturer;
use Sirce\Models\Mcu;
use Sirce\Models\McuFamily;

class McusTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $mcuFamiliesIds = McuFamily::lists('id');
        $manufacturersIds = Manufacturer::lists('id');

        foreach (range(1, 200) as $index) {
            Mcu::create([
                'mcu_family_id'   => $faker->randomElement($mcuFamiliesIds),
                'manufacturer_id' => $faker->randomElement($manufacturersIds),
                'mcu'             => $faker->word
            ]);
        }
    }

}
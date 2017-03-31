<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

use Sirce\Models\Manufacturer;
use Sirce\Models\Board;
use Sirce\Models\BoardFamily;
use Sirce\Models\Mcu;

class BoardsTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $boardFamiliesIds = BoardFamily::lists('id');
        $mcusIds = Mcu::lists('id');
        $manufacturersIds = Manufacturer::lists('id');

        foreach (range(1, 200) as $index) {
            Board::create([
                'board_family_id' => $faker->randomElement($boardFamiliesIds),
                'mcu_id'          => $faker->randomElement($mcusIds),
                'manufacturer_id' => $faker->randomElement($manufacturersIds),
                'board'           => $faker->word,
                'description'     => $faker->text,
                'website'         => $faker->url
            ]);
        }
    }

}
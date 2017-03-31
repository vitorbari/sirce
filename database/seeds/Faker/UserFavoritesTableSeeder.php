<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Carbon\Carbon;

use Sirce\Models\Reference;
use Sirce\Models\User;

class UserFavoritesTableSeeder extends Seeder
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
        $referencesIds = Reference::lists('id');

        $rows = [];

        $now = Carbon::create();

        foreach (range(1, 600) as $index) {

            $rows[] = [
                'user_id' => $faker->randomElement($usersIds),
                'reference_id' => $faker->randomElement($referencesIds),
                'created_at' => $now,
                'updated_at' => $now
            ];

        }

        DB::table('user_favorites')
            ->insert(array_unique($rows, SORT_REGULAR));

    }

}
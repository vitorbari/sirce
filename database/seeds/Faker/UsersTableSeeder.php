<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

use Sirce\Models\User;

class UsersTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 15) as $index) {
            User::create([
                'name'     => $faker->name,
                'email'    => $faker->email,
                'password' => Hash::make($faker->word)
            ]);
        }
    }

}
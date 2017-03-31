<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

use Sirce\Models\Language;

class LanguagesTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Language::create([
            'language' => 'Assembly'
        ]);

        Language::create([
            'language' => 'C'
        ]);

        Language::create([
            'language' => 'C++'
        ]);

        Language::create([
            'language' => 'Go'
        ]);

        Language::create([
            'language' => 'Java'
        ]);

        Language::create([
            'language' => 'JavaScript'
        ]);

        Language::create([
            'language' => 'Python'
        ]);
    }

}
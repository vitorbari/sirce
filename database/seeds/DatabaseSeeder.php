<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{


    protected $tables = [
//        'boards',
//        'board_families',

//        'components',
//        'component_categories',

        'languages',

//        'manufacturers',

//        'mcus',
//        'mcu_families',

//        'pictures',

//        'references',
//		  'reference_boards',

//        'users',

//        'user_favorites',
    ];


    protected $seeders = [
//        'UsersTableSeeder',
//
//        'ManufacturersTableSeeder',
//
//        'McuFamiliesTableSeeder',
//        'McusTableSeeder',
//
//        'BoardFamiliesTableSeeder',
//        'BoardsTableSeeder',
//
//        'ComponentCategoriesTableSeeder',
//        'ComponentsTableSeeder',
//
        'LanguagesTableSeeder',
//
//        'ReferencesTableSeeder',
//
//        'UserFavoritesTableSeeder'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->cleanDatabase();

        foreach ($this->seeders as $seedClass) {
            $this->call($seedClass);
        }
    }

    private function cleanDatabase()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        foreach ($this->tables as $table) {
            DB::table($table)->truncate();
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }

}

<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class I18nLangSeeder extends Seeder
{
    public function run()
    {
        DB::table('i18n_lang')->insert([ 'id' => 1, 'code' => 'fr', 'name' => 'Français', 'enabled' => true ]);
        DB::table('i18n_lang')->insert([ 'id' => 2, 'code' => 'en', 'name' => 'Anglais', 'enabled' => true ]);
    }
}

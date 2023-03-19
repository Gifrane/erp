<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class I18nCountrySeeder extends Seeder
{
    public function run()
    {
        DB::table('i18n_country')->insert([ 'id' => 1, 'code' => 'fr', 'name' => 'France', 'enabled' => true ]);
    }
}

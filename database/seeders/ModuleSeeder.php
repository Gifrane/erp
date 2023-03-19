<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModuleSeeder extends Seeder
{
    public function run()
    {
        DB::table('module')->insert([ 'id' => 1, 'code' => 'crm', 'name' => 'CRM' ]);
        DB::table('module')->insert([ 'id' => 2, 'code' => 'compta_billing', 'name' => 'Gestion des factures' ]);
        DB::table('module')->insert([ 'id' => 3, 'code' => 'file_explorer', 'name' => 'Explorateur de fichiers' ]);
        DB::table('module')->insert([ 'id' => 4, 'code' => 'product', 'name' => 'Gestion de produit' ]);
    }
}

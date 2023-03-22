<?php

namespace App\Console\Commands;

use App\Models\Account\AccountAdmin;
use App\Models\Company\Company;
use App\Models\I18n\I18nCountry;
use App\Models\User\User;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class Install extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'erp:install';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $company_name = $this->ask('Company name ?');

        $this->info('Administrator creation');

        $firstname = $this->ask('Firstname of the administrator ?');
        $lastname = $this->ask('Lastname of the administrator ?');
        $email = $this->ask('Email of the administrator ?');
        $function = $this->ask('Function of the administrator ?');

        $country = I18nCountry::first();

        $company = new Company();
        $company->name = $company_name;
        $company->save();

        $user = new User();
        $user->company_id = $company->id;
        $user->email = $email;
        $user->password = Hash::make('test', [ 'memory' => 1024, 'time' => 2, 'threads' => 2 ]);
        $user->firstname = $firstname;
        $user->lastname = $lastname;
        $user->avatar = 'upl/default_picture.jpg';
        $user->active = true;
        $user->enabled_at = now();
        $user->i18n_country_id = $country->id;
        $user->lang = 'fr';
        $user->timezone = 'Europe/Paris';
        $user->date_format = 'YYYY-MM-DD';
        $user->role = $function;
        $user->save();

        $account_admin = new AccountAdmin();
        $account_admin->user_id = $user->id;
        $account_admin->save();
    }
}
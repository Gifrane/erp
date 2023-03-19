<?php

namespace App\Console\Commands;

use App\Models\Company\Company;
use App\Models\User\User;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:user';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $firstname = $this->ask('Prénom');
        $lastname = $this->ask('Nom');
        $email = $this->ask('Email');
        $function = $this->ask('Fonction');

        $company = Company::first();

        $user = new User();
        $user->company_id = $company->id;
        $user->email = $email;
        $user->password = Hash::make('test', [ 'memory' => 1024, 'time' => 2, 'threads' => 2 ]);
        $user->firstname = $firstname;
        $user->lastname = $lastname;
        $user->avatar = 'upl/default_picture.jpg';
        $user->active = true;
        $user->enabled_at = now();
        $user->i18n_country_id = 690721601877442561;
        $user->lang = 'en';
        $user->timezone = 'Europe/Paris';
        $user->date_format = 'YYYY-MM-DD';
        $user->role = $function;
        $user->save();
    }
}
<?php

namespace App\Models\Company;

use App\Models\User\User;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'company';

    public function users()
    {
        return $this->hasMany(User::class, 'company_id');
    }
}

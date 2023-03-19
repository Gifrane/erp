<?php

namespace App\Models\Account;

use App\Models\User\User;

use Illuminate\Database\Eloquent\Model;

class AccountAdmin extends Model
{
    public $timestamps = false;

    protected $table = 'account_admin';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

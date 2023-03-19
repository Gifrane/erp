<?php

namespace App\Models\Account;

use App\Models\Module;

use Illuminate\Database\Eloquent\Model;

class AccountModule extends Model
{
    protected $table = 'account_module';

    public function module()
    {
        return $this->belongsTo(Module::class, 'module_id');
    }
}

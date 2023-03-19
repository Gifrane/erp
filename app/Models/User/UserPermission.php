<?php

namespace App\Models\User;

use App\Models\Module;
use App\Models\User\User;

use Illuminate\Database\Eloquent\Model;

use function json_decode;

class UserPermission extends Model
{
    protected $table = 'user_permission';

    protected static function booted()
    {
        static::retrieved(function ($permission) {
            if ($permission->type === 'integer') {
                $permission->value = (int) $permission->value;
            } elseif ($permission->type === 'boolean') {
                $permission->value = ($permission->value === 'true');
            } elseif ($permission->type === 'json' || $permission->type === 'array') {
                $permission->value = json_decode($permission->value, true);
            }

            return $permission;
        });
    }

    public function module()
    {
        return $this->belongsTo(Module::class, 'module_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

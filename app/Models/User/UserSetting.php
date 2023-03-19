<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class UserSetting extends Model
{
    public $timestamps = false;

    protected $table = 'user_setting';

    public static function boot()
    {
        parent::boot();

        static::retrieved(function ($model) {
            if ($model->type === 'boolean') {
                $model->value = ($model->value === 'true');
            }
        });
    }
}

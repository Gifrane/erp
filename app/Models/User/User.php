<?php

namespace App\Models\User;

use App\Models\I18n\I18nCountry;
use App\Models\User\UserPermission;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use SoftDeletes;

    public $timestamps = true;

    protected $table = 'user';

    public function bookmarks()
    {
        return $this->belongsToMany(Project::class, 'project_bookmark', 'user_id', 'project_id');
    }

    public function permissions()
    {
        return $this->hasMany(UserPermission::class, 'user_id');
    }

    public function country()
    {
        return $this->belongsTo(I18nCountry::class, 'i18n_country_id');
    }
}

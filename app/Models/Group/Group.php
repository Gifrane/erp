<?php

namespace App\Models\Group;

use App\Models\User\User;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    public $timestamps = true;

    protected $table = 'group';

    public function users()
    {
        return $this->belongsToMany(User::class, 'group_user', 'group_id', 'user_id');
    }
}

<?php

namespace App\Models;

use App\Models\User\User;

use Illuminate\Database\Eloquent\Model;

class ApiKeys extends Model
{
    protected $table = 'api_keys';

    protected $casts = [
        'modules' => 'array',
    ];

    public function generator()
    {
        return $this->belongsTo(User::class, 'generated_by_user_id');
    }
}

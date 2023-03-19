<?php

namespace App\Models\Crm;

use App\Models\User\User;

use Illuminate\Database\Eloquent\Model;

class CrmGroup extends Model
{
    protected $table = 'crm_group';

    public function contacts()
    {
        return $this->belongsToMany(CrmContact::class, 'crm_contact_group', 'crm_group_id', 'crm_contact_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }
}

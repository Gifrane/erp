<?php

namespace App\Models\Crm;

use App\Models\Tag;

use Illuminate\Database\Eloquent\Model;

class CrmContact extends Model
{
    protected $table = 'crm_contact';

    public function companies()
    {
        return $this->belongsToMany(CrmCompany::class, 'crm_contact_company', 'crm_contact_id', 'crm_company_id')
            ->withPivot([ 'function', 'email', 'phone' ]);
    }

    public function groups()
    {
        return $this->belongsToMany(CrmGroup::class, 'crm_contact_group', 'crm_contact_id', 'crm_group_id');
    }

    public function tags()
    {
        return $this->morphMany(Tag::class, 'entity');
    }
}

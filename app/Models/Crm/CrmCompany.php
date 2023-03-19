<?php

namespace App\Models\Crm;

use App\Models\I18n\I18nCountry;

use Illuminate\Database\Eloquent\Model;

class CrmCompany extends Model
{
    protected $table = 'crm_company';

    public function contacts()
    {
        return $this->belongsToMany(CrmContact::class, 'crm_contact_company', 'crm_company_id', 'crm_contact_id');
    }

    public function country()
    {
        return $this->belongsTo(I18nCountry::class, 'i18n_country_id');
    }

    public function tags()
    {
        return $this->hasMany(CrmCompanyTag::class, 'crm_company_id');
    }
}

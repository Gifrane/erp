<?php

namespace App\Actions\Dashboard;

use App\Models\Crm\CrmCompany;
use App\Models\Crm\CrmContact;
use App\Models\Crm\CrmGroup;

use function app;
use function number_format;

class CrmContentAction
{
    /**
     * @return array
     */
    public function execute(): array
    {
        try {
            $account_id = app()->account->id;

            $contacts = CrmContact::where('account_id', $account_id)->count();
            $groups = CrmGroup::where('account_id', $account_id)->count();
            $companies = CrmCompany::where('account_id', $account_id)->count();

            $data = [];
            $data['contacts'] = number_format($contacts, 0, '.', ' ');
            $data['groups'] = number_format($groups, 0, '.', ' ');
            $data['companies'] = number_format($companies, 0, '.', ' ');

            return [ 'success' => true, 'data' => $data ];
        } catch (\Exception $e) {
            throw new \Exception('dashboard.crm.content.error_during_retrieving', 500, $e);
        }
    }
}

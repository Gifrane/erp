<?php

namespace App\Actions\Crm\Contact;

use App\Models\Tag;
use App\Models\Crm\CrmCompany;
use App\Models\Crm\CrmGroup;

use function app;

class AddContentAction
{
    /**
     * @return array
     */
    public function execute(): array
    {
        try {
            $account_id = app()->account->id;

            $tags = Tag::where('account_id', $account_id)->where('module', 'crm_contact')
                ->select('id', 'name')->orderBy('name', 'ASC')
                ->get()->toArray();

            return [
                'success' => true,
                'data' => [
                    'groups' => CrmGroup::where('account_id', $account_id)->select('id', 'name')->orderBy('name', 'ASC')->get()->toArray(),
                    'companies' => CrmCompany::where('account_id', $account_id)->select('id', 'name')->orderBy('name', 'ASC')->get()->toArray(),
                    'tags' => $tags
                ]
            ];
        } catch (\Exception $e) {
            throw new \Exception('crm.contacts.add_content.error_during_retrieving', 500, $e);
        }
    }
}

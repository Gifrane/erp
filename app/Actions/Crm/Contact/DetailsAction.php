<?php

namespace App\Actions\Crm\Contact;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use function __;
use function app;
use function collect;

class DetailsAction
{
    /**
     * @return array
     */
    public function execute(): array
    {
        try {
            $contact = app()->contact;
            $contact->load([ 'companies' ]);

            $contactArray = $contact->toArray();

            $contactArray['companies'] = $contact->companies->map(function ($company) {
                return collect($company)->only([ 'id', 'name', 'pivot' ]);
            });

            $contactArray['groups'] = DB::table('crm_contact_group')->where('crm_contact_id', $contact->id)
                ->select(DB::raw('CAST(crm_group_id AS string) AS crm_group_id'))
                ->get()->pluck('crm_group_id');

            $contactArray['tags'] = DB::table('tag_link', 'tl')->where('tl.account_id', app()->account->id)
                ->where('tl.entity_type', 'crm_contact')->where('tl.entity_id', $contact->id)
                ->leftJoin('tag', 'tag.id', 'tl.tag_id')
                ->select(DB::raw('CAST(tag.id AS string) AS id'))
                ->get()->pluck('id')->toArray();

            return [ 'success' => true, 'data' => $contactArray ];
        } catch (\Exception $e) {
            Log::error($e);

            return [ 'success' => false, 'status' => 500, 'errors' => [ __('general.error_during_retrieving') ] ];
        }
    }
}

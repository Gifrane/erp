<?php

namespace App\Actions\Crm\Contact;

use App\Models\Crm\CrmCompany;
use App\Models\Crm\CrmContact;
use App\Models\Crm\CrmGroup;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use function __;
use function app;
use function auth;

class AddAction
{
    /**
     * @param array $params
     * @return array
     */
    public function execute(array $params): array
    {
        try {
            $account_id = app()->account->id;

            $vars = $params + [ 'companies' => [], 'groups' => [], 'country' => null, 'phone' => null ];
            $country = $vars['country'];

            if (!empty($vars['country']) && DB::table('i18n_country')->where('id', $params['country'])->count() === 0) {
                $country = null;
            }

            $groups = CrmGroup::where('account_id', $account_id)->whereIn('id', $vars['groups'])->toBase()->get()->pluck('id')->toArray();
            $companies = CrmCompany::where('account_id', $account_id)->whereIn('id', $vars['companies'])->toBase()->get()->pluck('id')->toArray();

            $contact = new CrmContact();
            $contact->account_id = $account_id;
            $contact->source = 'app';
            $contact->firstname = $vars['firstname'];
            $contact->lastname = $vars['lastname'];
            $contact->email = $vars['email'];
            $contact->creator_id = auth()->id();
            $contact->i18n_country_id = $country;
            $contact->phone = $vars['phone'];
            $contact->save();

            $contact->companies()->attach($companies);
            $contact->groups()->attach($groups);

            return [ 'success' => true, 'data' => $contact->id ];
        } catch (\Exception $e) {
            Log::error($e);

            return [ 'success' => false, 'status' => 500, 'errors' => [ __('general.error_during_creation') ] ];
        }
    }
}

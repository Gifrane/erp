<?php

namespace App\Actions\Crm\Contact;

use App\Models\TagLink;
use App\Models\Crm\CrmCompany;
use App\Models\Crm\CrmGroup;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use function __;
use function app;
use function collect;
use function in_array;

class EditAction
{
    /**
     * @param array $params
     * @return array
     */
    public function execute(array $params): array
    {
        try {
            $vars = $params + [ 'companies' => [], 'groups' => [], 'country' => null, 'tags' => [], 'phone' => null ];

            $account_id = app()->account->id;
            $contact = app()->contact;
            $country = $vars['country'];

            if (!empty($vars['country']) && DB::table('i18n_country')->where('id', $params['country'])->count() === 0) {
                $country = null;
            }

            $companies_id = collect($vars['companies'])->pluck('id')->toArray();

            $groups = CrmGroup::whereIn('id', $vars['groups'])->where('account_id', $account_id)->get()->pluck('id')->toArray();
            $companies = CrmCompany::whereIn('id', $companies_id)->where('account_id', $account_id)->get()->pluck('id')->toArray();

            $contact->firstname = $vars['firstname'];
            $contact->lastname = $vars['lastname'];
            $contact->email = $vars['email'];
            $contact->i18n_country_id = $country;
            $contact->phone = $vars['phone'];
            $contact->save();

            $companiesFormat = [];

            foreach ($vars['companies'] as $company) {
                if (in_array($company['id'], $companies)) {
                    $companiesFormat[ $company['id'] ] = [
                        'function' => $company['pivot']['function'] ?? null,
                        'email' => $company['pivot']['email'] ?? null,
                        'phone' => $company['pivot']['phone'] ?? null
                    ];
                }
            }

            $contact->companies()->sync($companiesFormat);
            $contact->groups()->sync($groups);

            // Tags management
            $currentTags = DB::table('tag_link')->where('account_id', $account_id)
                ->where('entity_type', 'crm_contact')->where('entity_id', $contact->id)
                ->select('tag_id')->get()->pluck('tag_id');

            $refreshTags = DB::table('tag')->where('account_id', $account_id)
                ->whereIn('id', $vars['tags'])->select('id')->get()->pluck('id');

            foreach ($currentTags as $t) {
                if (!$refreshTags->contains($t)) {
                    // Le tag de la liste de base n'existe pas dans la liste à jour : On le supprime
                    DB::table('tag_link')->where('account_id', $account_id)->where('tag_id', $t)
                        ->where('entity_type', 'crm_contact')->where('entity_id', $contact->id)
                        ->delete();
                }
            }

            foreach ($refreshTags as $t) {
                if (!$currentTags->contains($t)) {
                    // Le tag n'est pas dans la liste de base : On l'ajoute
                    $tag = new TagLink();
                    $tag->account_id = $account_id;
                    $tag->tag_id = $t;
                    $tag->entity_type = 'crm_contact';
                    $tag->entity_id = $contact->id;
                    $tag->save();
                }
            }

            return [ 'success' => true ];
        } catch (\Exception $e) {
            Log::error($e);

            return [ 'success' => false, 'status' => 500, 'errors' => [ __('general.error_during_update') ] ];
        }
    }
}

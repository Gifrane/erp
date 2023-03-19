<?php

namespace App\Actions\Crm\Contact;

use Illuminate\Support\Facades\DB;

use function app;

class DestroyAction
{
    /**
     * @return array
     */
    public function execute(): array
    {
        try {
            $contact = app()->contact;

            DB::table('crm_contact_company')->where('crm_contact_id', app()->account->id)->delete();
            DB::table('crm_contact_group')->where('crm_contact_id', $contact->id)->delete();

            $contact->forceDelete();

            return [ 'success' => true ];
        } catch (\Exception $e) {
            throw new \Exception('crm.contacts.destroy.error_during_delete', 500, $e);
        }
    }
}

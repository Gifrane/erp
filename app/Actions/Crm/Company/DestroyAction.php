<?php

namespace App\Actions\Crm\Company;

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
            $company = app()->company;

            DB::table('crm_contact_company')->where('crm_company_id', $company->id)->delete();
            DB::table('crm_sales')->where('client_crm_company_id', $company->id)->update([ 'client_crm_company_id' => null ]);

            $company->forceDelete();

            return [ 'success' => true ];
        } catch (\Exception $e) {
            throw new \Exception('crm.companies.destroy.error_during_delete', 500, $e);
        }
    }
}

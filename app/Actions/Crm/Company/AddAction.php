<?php

namespace App\Actions\Crm\Company;

use App\Models\Crm\CrmCompany;

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
            $country = $params['country'] ?? null;

            if (!empty($params['country']) && DB::table('i18n_country')->where('id', $params['country'])->count() === 0) {
                $country = null;
            }

            $company = new CrmCompany();
            $company->account_id = $account_id;
            $company->source = 'app';
            $company->name = $params['name'];
            $company->i18n_country_id = $country;
            $company->creator_id = auth()->id();
            $company->save();

            return [ 'success' => true, 'data' => $company->id ];
        } catch (\Exception $e) {
            Log::error($e);

            return [ 'success' => false, 'status' => 500, 'errors' => [ __('general.error_during_creation') ] ];
        }
    }
}

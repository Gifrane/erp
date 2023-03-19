<?php

namespace App\Actions\Crm\Company;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use function __;
use function app;

class EditAction
{
    /**
     * @param array $params
     * @return array
     */
    public function execute(array $params): array
    {
        try {
            $tags = $params['tags'] ?? [];

            if (!empty($params['country']) && DB::table('i18n_country')->where('id', $params['country'] ?? 0)->count() === 0) {
                $params['country'] = null;
            }

            $company = app()->company;
            $company->name = $params['name'];
            $company->i18n_country_id = $params['country'] ?? null;
            $company->city = $params['city'] ?? null;
            $company->postal_address = $params['postal_address'] ?? null;
            $company->postal_code = $params['postal_code'] ?? null;
            $company->website = $params['website'] ?? null;
            $company->interval_employee = $params['interval'] ?? null;
            $company->annual_revenues = $params['annual_revenues'] ?? null;
            $company->description = $params['description'] ?? null;
            $company->save();

            return [ 'success' => true ];
        } catch (\Exception $e) {
            Log::error($e);

            return [ 'success' => false, 'status' => 500, 'errors' => [ __('general.error_during_update') ] ];
        }
    }
}

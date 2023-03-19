<?php

namespace App\Actions\Admin\Companies;

use App\Models\Company\Company;

use Illuminate\Support\Facades\Log;

use function __;

class SearchAction
{
    /**
     * @param array $params
     * @return array
     */
    public function execute(array $params): array
    {
        try {
            $companies = Company::withCount('users')
                ->orderBy($params['order_column'], $params['order_order'])
                ->paginate($params['per_page'], ['*'], 'page', $params['page']);

            return [ 'success' => true, 'data' => $companies->toArray() ];
        } catch (\Exception $e) {
            Log::error($e);

            return [ 'success' => false, 'status' => 500, 'errors' => [ __('general.error_during_retrieving') ] ];
        }
    }
}

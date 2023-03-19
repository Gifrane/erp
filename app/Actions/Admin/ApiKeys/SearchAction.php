<?php

namespace App\Actions\Admin\ApiKeys;

use App\Models\ApiKeys;

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
            $data = ApiKeys::paginate($params['per_page'], ['*'], 'page', $params['page']);

            return [ 'success' => true, 'data' => $data ];
        } catch (\Exception $e) {
            Log::error($e);

            return [ 'success' => false, 'status' => 500, 'errors' => [ __('general.error_during_retrieving') ] ];
        }
    }
}

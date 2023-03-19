<?php

namespace App\Actions\Admin\ApiKeys;

use App\Models\ApiKeys;

use Illuminate\Support\Facades\Log;

use function __;
use function is_null;

class DestroyAction
{
    /**
     * @param array $params
     * @return array
     */
    public function execute(array $params): array
    {
        try {
            $keys = ApiKeys::where('id', $params['keys'])->first();

            if (is_null($keys)) {
                return [ 'success' => false, 'status' => 404, 'errors' => [ __('general.error_during_deletion') ] ];
            }

            $keys->forceDelete();

            return [ 'success' => true ];
        } catch (\Exception $e) {
            Log::error($e);

            return [ 'success' => false, 'status' => 500, 'errors' => [ __('general.error_during_deletion') ] ];
        }
    }
}

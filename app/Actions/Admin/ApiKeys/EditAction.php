<?php

namespace App\Actions\Admin\ApiKeys;

use App\Models\ApiKeys;

use Illuminate\Support\Facades\Log;

use function __;
use function is_null;

class EditAction
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
                return [ 'success' => false, 'status' => 404, 'errors' => [ __('general.error_during_update') ] ];
            }

            $keys->name = $params['name'];
            $keys->public_key = $params['public_key'];
            $keys->private_key = $params['private_key'];
            $keys->expired_at = $params['expired_at'] ?? null;
            $keys->modules = $params['modules'] ?? [];
            $keys->save();

            return [ 'success' => true ];
        } catch (\Exception $e) {
            Log::error($e);

            return [ 'success' => false, 'status' => 500, 'errors' => [ __('general.error_during_update') ] ];
        }
    }
}

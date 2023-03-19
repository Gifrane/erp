<?php

namespace App\Actions\Supplier;

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
            $supplier = app()->supplier;
            $supplier->name = $params['name'];
            $supplier->is_manufacturer = $params['is_manufacturer'];
            $supplier->is_provider = $params['is_provider'];
            $supplier->save();

            return [ 'success' => true ];
        } catch (\Exception $e) {
            Log::error($e);

            return [ 'success' => false, 'status' => 500, 'errors' => [ __('general.error_during_update') ] ];
        }
    }
}

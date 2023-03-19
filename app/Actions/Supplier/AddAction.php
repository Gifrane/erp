<?php

namespace App\Actions\Supplier;

use App\Models\Supplier\Supplier;

use Illuminate\Support\Facades\Log;

use function __;
use function app;

class AddAction
{
    /**
     * @param array $params
     * @return array
     */
    public function execute(array $params): array
    {
        try {
            $supplier = new Supplier();
            $supplier->account_id = app()->account->id;
            $supplier->name = $params['name'];
            $supplier->is_manufacturer = $params['is_manufacturer'];
            $supplier->is_provider = $params['is_provider'];
            $supplier->save();

            return [ 'success' => true, 'data' => $supplier->id ];
        } catch (\Exception $e) {
            Log::error($e);

            return [ 'success' => false, 'status' => 500, 'errors' => [ __('general.error_during_creation') ] ];
        }
    }
}

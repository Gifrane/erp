<?php

namespace App\Actions\Data;

use App\Models\Supplier\Supplier;

use Illuminate\Support\Facades\Log;

use function __;
use function app;

class ProductSparePartDetailsAction
{
    /**
     * @return array
     */
    public function execute(): array
    {
        try {
            $account_id = app()->account->id;

            $data = [];
            $data['providers'] = Supplier::account($account_id)->where('is_provider', true)->orderBy('name', 'ASC')->get();
            $data['manufacturers'] = Supplier::account($account_id)->where('is_manufacturer', true)->orderBy('name', 'ASC')->get();

            return [ 'success' => true, 'data' => $data ];
        } catch (\Exception $e) {
            Log::error($e);

            return [ 'success' => false, 'status' => 500, 'errors' => [ __('general.error_during_retrieving') ] ];
        }
    }
}

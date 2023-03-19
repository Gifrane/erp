<?php

namespace App\Actions\Supplier;

use Illuminate\Support\Facades\Log;

use function __;
use function app;

class DetailsAction
{
    /**
     * @return array
     */
    public function execute(): array
    {
        try {
            $supplier = app()->supplier;

            return [ 'success' => true, 'data' => $supplier ];
        } catch (\Exception $e) {
            Log::error($e);

            return [ 'success' => false, 'status' => 500, 'errors' => [ __('general.error_during_retrieving') ] ];
        }
    }
}

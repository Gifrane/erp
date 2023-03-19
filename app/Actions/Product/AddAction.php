<?php

namespace App\Actions\Product;

use App\Models\Product\Product;

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
            $product = new Product();
            $product->account_id = app()->account->id;
            $product->name = $params['name'];
            $product->price_before_tax = $params['price_before_tax'];
            $product->price_with_tax = $params['price_with_tax'];
            $product->tva = $params['tva'];
            $product->fabrication_cost = 0;
            $product->save();

            return [ 'success' => true, 'data' => $product->id ];
        } catch (\Exception $e) {
            Log::error($e);

            return [ 'success' => false, 'status' => 500, 'errors' => __('general.error_during_creation') ];
        }
    }
}

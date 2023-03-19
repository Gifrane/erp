<?php

namespace App\Actions\Product;

use App\Models\Product\ProductOption;
use App\Models\Product\ProductSales;

use Illuminate\Support\Facades\Log;

use function __;
use function app;
use function in_array;

class DetailsAction
{
    /**
     * @param array $params
     * @return array
     */
    public function execute(array $params): array
    {
        try {
            $relations = $params['relations'] ?? [];
            $product = app()->product->toArray();

            if (in_array('options', $relations)) {
                $product['options'] = ProductOption::where('product_id', $product['id'])->get()->toArray();
            }

            if (in_array('sales', $relations)) {
                $product['sales'] = ProductSales::where('product_id', $product['id'])->get()->toArray();
            }

            return [ 'success' => true, 'data' => $product ];
        } catch (\Exception $e) {
            Log::error($e);

            return [ 'success' => false, 'status' => 500, 'errors' => [ __('general.error_during_retrieving') ] ];
        }
    }
}

<?php

namespace App\Actions\Product\SpareParts;

use App\Models\Product\ProductSparePart;

use Illuminate\Support\Facades\Log;

use function __;
use function app;
use function gettype;
use function number_format;

class DetailsAction
{
    /**
     * @return array
     */
    public function execute(): array
    {
        try {
            $product = app()->product->toArray();

            $product['spare_parts'] = ProductSparePart::where('product_id', $product['id'])
                ->with([ 'manufacturer', 'provider' ])
                ->get()
                ->map(function ($sp) {
                    $decimals = (gettype($sp->price) === 'float') ? 2 : 0;

                    $sp->price = number_format($sp->price, $decimals, '.', ' ');

                    return $sp;
                })
                ->toArray();

            return [ 'success' => true, 'data' => $product ];
        } catch (\Exception $e) {
            Log::error($e);

            return [ 'success' => false, 'status' => 500, 'errors' => [ __('general.error_during_retrieving') ] ];
        }
    }
}

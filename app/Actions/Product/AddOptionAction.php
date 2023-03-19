<?php

namespace App\Actions\Product;

use App\Models\Product\ProductOption;

use function app;

class AddOptionAction
{
    /**
     * @param array $params
     * @return array
     */
    public function execute(array $params): array
    {
        try {
            $option = new ProductOption();
            $option->account_id = app()->account->id;
            $option->product_id = app()->product->id;
            $option->name = $params['name'];
            $option->price = $params['price'];
            $option->save();

            return [ 'success' => true ];
        } catch (\Exception $e) {
            throw new \Exception('product.add_option.error_during_creation', 500, $e);
        }
    }
}

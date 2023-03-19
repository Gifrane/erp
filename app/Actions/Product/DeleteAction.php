<?php

namespace App\Actions\Product;

use function app;

class DeleteAction
{
    /**
     * @return array
     */
    public function execute(): array
    {
        try {
            $product = app()->product;
            $product->forceDelete();

            return [ 'success' => true ];
        } catch (\Exception $e) {
            throw new \Exception('product.delete.error_during_destroy', 500, $e);
        }
    }
}

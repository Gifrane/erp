<?php
namespace App\Actions\Product;

use App\Models\Product\ProductOption;

use Illuminate\Support\Facades\Cache;

use function app;
use function is_null;

class DeleteOptionAction
{
    /**
     * @param array $params
     * @return array
     */
    public function execute(array $params): array
    {
        try {
            $accountId = app()->account->id;
            $productId = app()->product->id;

            $optionId = $params['id'];
    
            $option = ProductOption::where('id', $optionId)->where('product_id', $productId)->where('account_id', $accountId)->first();

            if (is_null($option)) {
                throw new \Exception('option_'.$optionId.'_'.$productId.'_'.$accountId.'_not_exists', 500);
            }

            $option->forceDelete();

            Cache::tags('account:'.$accountId.':search:product')->flush();

            return [ 'success' => true ];
        } catch (\Exception $e) {
            throw new \Exception('product.delete.option.error_during_destroy', 500, $e);
        }
    }
}

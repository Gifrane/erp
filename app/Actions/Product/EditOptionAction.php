<?php
namespace App\Actions\Product;

use App\Models\Product\ProductOption;

use Illuminate\Support\Facades\Cache;

use function app;
use function is_null;

class EditOptionAction
{
    /**
     * @param array $params
     * @return array
     */
    public function execute(array $params): array
    {
        $accountId = app()->account->id;
        $productId = app()->product->id;

        $optionId = $params['id'];

        try {
            $option = ProductOption::where('id', $optionId)->where('product_id', $productId)->where('account_id', $accountId)->first();

            if (is_null($option)) {
                throw new \Exception('option_'.$optionId.'_'.$productId.'_'.$accountId.'_not_exists', 500);
            }

            $option->name = $params['name'];
            $option->price = $params['price'];
            $option->save();

            Cache::tags('account:'.$accountId.':search:product')->flush();

            return [ 'success' => true ];
        } catch (\Exception $e) {
            throw new \Exception('product.edit_option.error_during_update', 500, $e);
        }
    }
}

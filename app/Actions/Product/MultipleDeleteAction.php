<?php

namespace App\Actions\Product;

use Illuminate\Support\Facades\DB;

use function app;

class MultipleDeleteAction
{
    /**
     * @param array $params
     * @return array
     */
    public function execute(array $params): array
    {
        try {
            DB::table('product')->whereIn('id', $params['products'])->where('account_id', app()->account->id)->delete();

            return [ 'success' => true ];
        } catch (\Exception $e) {
            throw new \Exception('product.multiple_delete.error_during_destroy', 500, $e);
        }
    }
}

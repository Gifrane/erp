<?php

namespace App\Actions\Product;

use App\Models\Bookmark;
use App\Models\Product\Product;

use Illuminate\Support\Facades\Log;

use function __;
use function app;
use function auth;
use function collect;
use function config;
use function gettype;
use function number_format;
use function str_repeat;

class SearchAction
{
    /**
     * @param array $params
     * @return array
     */
    public function execute(array $params): array
    {
        try {
            $division = (int) ('1'.str_repeat('0', config('decimals.products_price')));

            $products = Product::where('account_id', app()->account->id)
                ->when(!empty($params['search']), function ($query) use ($params) {
                    $query->where('name', 'ILIKE', '%'.$params['search'].'%');
                })
                ->orderBy($params['order_column'], $params['order_order'])->with([ 'company' ])
                ->paginate($params['per_page'], [ '*' ], 'page', $params['page']);

            $data = $products->toArray();

            $data['data'] = collect($data['data'])->map(function ($product) use ($division) {
                $before_tax = $product['price_before_tax'] / $division;
                $with_tax = $product['price_with_tax'] / $division;

                $decimals_before = (gettype($before_tax) === 'double') ? 2 : 0;
                $decimals_with = (gettype($with_tax) === 'double') ? 2 : 0;

                $product['price_before_tax'] = number_format($before_tax, $decimals_before, '.', ' ');
                $product['price_with_tax'] = number_format($with_tax, $decimals_with, '.', ' ');

                return $product;
            })->toArray();

            $data['bookmarks'] = Bookmark::select('entity_id')->where('entity_type', 'product')
                ->whereIn('entity_id', collect($data['data'])->pluck('id')->toArray())
                ->where('user_id', auth()->id())
                ->get()->pluck('entity_id')->toArray();

            return [ 'success' => true, 'data' => $data ];
        } catch (\Exception $e) {
            Log::error($e);

            return [ 'success' => false, 'status' => 500, 'errors' => [ __('general.error_during_retrieving') ] ];
        }
    }
}

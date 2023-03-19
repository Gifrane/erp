<?php

namespace App\Actions\Product\SpareParts;

use App\Models\Product\ProductSparePart;
use App\Models\Supplier\Supplier;

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
            $account_id = app()->account->id;
            $product = app()->product;

            $manufacturer = null;
            $provider = null;

            if ($params['manufacturer']['display'] === 'select') {
                if (!is_null($params['manufacturer']['id'])) {
                    $manufacturer = Supplier::where('id', $params['manufacturer']['id'])
                        ->where('is_manufacturer', true)
                        ->account($account_id)
                        ->first()->id ?? null;
                }
            } elseif ($params['manufacturer']['display'] === 'create') {
                if (!empty($params['manufacturer']['name'])) {
                    $manufacturer_model = Supplier::where('name', $params['manufacturer']['name'])
                        ->account($account_id)
                        ->first();

                    if (is_null($manufacturer_model)) {
                        $manufacturer_model = new Supplier();
                        $manufacturer_model->account_id = $account_id;
                        $manufacturer_model->name = $params['manufacturer']['name'];
                        $manufacturer_model->is_manufacturer = true;
                        $manufacturer_model->save();
                    } elseif (!$manufacturer_model->is_manufacturer) {
                        $manufacturer_model->is_manufacturer = true;
                        $manufacturer_model->save();
                    }

                    $manufacturer = $manufacturer_model->id;
                }
            }

            if ($params['provider']['display'] === 'select') {
                if (!is_null($params['provider']['id'])) {
                    $provider = Supplier::where('id', $params['provider']['id'])
                        ->where('is_provider', true)
                        ->account($account_id)
                        ->first()->id ?? null;
                }
            } elseif ($params['provider']['display'] === 'create') {
                if (!empty($params['provider']['name'])) {
                    $provider_model = Supplier::where('name', $params['provider']['name'])
                        ->account($account_id)
                        ->first();

                    if (is_null($provider_model)) {
                        $provider_model = new Supplier();
                        $provider_model->account_id = $account_id;
                        $provider_model->name = $params['provider']['name'];
                        $provider_model->is_provider = true;
                        $provider_model->save();
                    } elseif (!$provider_model->is_provider) {
                        $provider_model->is_provider = true;
                        $provider_model->save();
                    }

                    $provider = $provider_model->id;
                }
            }

            $spare_part = new ProductSparePart();
            $spare_part->account_id = $account_id;
            $spare_part->product_id = $product->id;
            $spare_part->name = $params['name'];
            $spare_part->amount = $params['amount'];
            $spare_part->price = $params['unit_cost'];
            $spare_part->supplier_manufacturer_id = $manufacturer;
            $spare_part->supplier_provider_id = $provider;
            $spare_part->save();

            return [ 'success' => true, 'data' => $product->id ];
        } catch (\Exception $e) {
            Log::error($e);

            return [ 'success' => false, 'status' => 500, 'errors' => __('general.error_during_creation') ];
        }
    }
}

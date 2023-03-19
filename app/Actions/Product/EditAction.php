<?php

namespace App\Actions\Product;

use Illuminate\Support\Facades\Log;

use function __;
use function app;

class EditAction
{
    /**
     * @param array $params
     * @return array
     */
    public function execute(array $params): array
    {
        try {
            $product = app()->product;

            //$spareParts = ProductSparePart::where('product_id', $product->id)->select('id')->get();

            $product->name = $params['name'];
            $product->family = $params['family'] ?? null;
            $product->price_before_tax = $params['price_before_tax'] ?? 0;
            $product->price_with_tax = $params['price_with_tax'] ?? 0;
            $product->tva = $params['tva'] ?? 0;
            $product->subscription_period = $params['subscription_period'] ?? null;
            //$product->fabrication_cost = $params['fabrication_cost'] ?? 0;
            $product->started_at = $params['started_at'] ?? null;
            $product->stopped_at = $params['stopped_at'] ?? null;
            $product->save();

            /*$newSpareParts = $params['spare_parts'];

            $currentIds = $spareParts->pluck('id');
            $newIds = collect($newSpareParts)->pluck('id');

            foreach ($spareParts as $sp) {
                if (!$newIds->contains($sp->id)) {
                    $sp->forceDelete();
                }
            }

            foreach ($newSpareParts as $sp) {
                if ($currentIds->contains($sp['id'])) {
                    $spPart = $spareParts->where('id', $sp['id'])->first();
                } elseif (!empty($sp['name'])) {
                    $spPart = new ProductSparePart();
                    $spPart->account_id = $accountId;
                    $spPart->product()->associate($product);
                } else {
                    continue;
                }

                $spPart->name = $sp['name'];
                $spPart->provider = $sp['provider'] ?? null;
                $spPart->manufacturer = $sp['manufacturer'] ?? null;
                $spPart->amount = $sp['amount'] ?? 0;
                $spPart->price = $sp['price'] ?? 0;
                $spPart->save();
            }*/

            return [ 'success' => true ];
        } catch (\Exception $e) {
            Log::error($e);

            return [ 'success' => false, 'status' => 500, 'errors' => [ __('general.error_during_update') ] ];
        }
    }
}

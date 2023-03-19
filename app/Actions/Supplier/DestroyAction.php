<?php

namespace App\Actions\Supplier;

use App\Models\Asset\Asset;
use App\Models\Product\ProductSparePart;

use function app;

class DestroyAction
{
    /**
     * @return array
     */
    public function execute(): array
    {
        try {
            $supplier = app()->supplier;

            Asset::where('supplier_provider_id', $supplier->id)->update([ 'supplier_provider_id' => null ]);
            Asset::where('supplier_manufacturer_id', $supplier->id)->update([ 'supplier_manufacturer_id' => null ]);

            ProductSparePart::where('supplier_provider_id', $supplier->id)->update([ 'supplier_provider_id' => null ]);
            ProductSparePart::where('supplier_manufacturer_id', $supplier->id)->update([ 'supplier_manufacturer_id' => null ]);

            $supplier->forceDelete();

            return [ 'success' => true ];
        } catch (\Exception $e) {
            throw new \Exception('infra.destroy.error_during_deleting', 500, $e);
        }
    }
}

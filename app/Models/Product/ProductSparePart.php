<?php

namespace App\Models\Product;

use App\Models\Supplier\Supplier;

use Illuminate\Database\Eloquent\Model;

class ProductSparePart extends Model
{
    public $timestamps = true;

    protected $table = 'product_spare_part';

    public function manufacturer()
    {
        return $this->belongsTo(Supplier::class, 'supplier_manufacturer_id');
    }

    public function provider()
    {
        return $this->belongsTo(Supplier::class, 'supplier_provider_id');
    }
}

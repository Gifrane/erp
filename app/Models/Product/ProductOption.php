<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class ProductOption extends Model
{
    public $timestamps = true;

    protected $table = 'product_option';

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}

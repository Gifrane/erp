<?php

namespace App\Models\Product;

use App\Models\Company\Company;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function spare_parts()
    {
        return $this->hasMany(ProductSparePart::class, 'product_id');
    }

    public function options()
    {
        return $this->hasMany(ProductOption::class, 'product_id');
    }
}

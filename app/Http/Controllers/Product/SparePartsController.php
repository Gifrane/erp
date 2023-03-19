<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\BaseController;

class SparePartsController extends BaseController
{
    protected string $actionsPath = 'App\Actions\Product\SpareParts';
    protected string $requestsPath = 'App\Http\Requests\Product\SpareParts';
}

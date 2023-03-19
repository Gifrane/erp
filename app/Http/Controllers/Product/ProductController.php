<?php
namespace App\Http\Controllers\Product;

use App\Http\Controllers\BaseController;

class ProductController extends BaseController
{
    protected string $actionsPath = 'App\Actions\Product';
    protected string $requestsPath = 'App\Http\Requests\Product';
}

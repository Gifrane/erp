<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;

class ApiKeysController extends BaseController
{
    protected string $actionsPath = 'App\Actions\Admin\ApiKeys';
    protected string $requestsPath = 'App\Http\Requests\Admin\ApiKeys';
}

<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;

class AdminController extends BaseController
{
    protected string $actionsPath = 'App\Actions\Admin';
    protected string $requestsPath = 'App\Http\Requests\Admin';
}

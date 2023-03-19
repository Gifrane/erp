<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;

class CompaniesController extends BaseController
{
    protected string $actionsPath = 'App\Actions\Admin\Companies';
    protected string $requestsPath = 'App\Http\Requests\Admin\Companies';
}

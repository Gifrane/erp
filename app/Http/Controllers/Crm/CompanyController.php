<?php
namespace App\Http\Controllers\Crm;

use App\Http\Controllers\BaseController;

class CompanyController extends BaseController
{
    protected string $actionsPath = 'App\Actions\Crm\Company';
    protected string $requestsPath = 'App\Http\Requests\Crm\Company';
}

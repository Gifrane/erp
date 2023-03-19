<?php
namespace App\Http\Controllers\Accounting;

use App\Http\Controllers\BaseController;

class BillingsController extends BaseController
{
    protected string $actionsPath = 'App\Actions\Accounting\Billings';
    protected string $requestsPath = 'App\Http\Requests\Accounting\Billings';
}

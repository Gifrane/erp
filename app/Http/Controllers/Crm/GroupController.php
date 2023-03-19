<?php
namespace App\Http\Controllers\Crm;

use App\Http\Controllers\BaseController;

class GroupController extends BaseController
{
    protected string $actionsPath = 'App\Actions\Crm\Group';
    protected string $requestsPath = 'App\Http\Requests\Crm\Group';
}

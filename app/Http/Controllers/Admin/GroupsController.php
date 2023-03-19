<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;

class GroupsController extends BaseController
{
    protected string $actionsPath = 'App\Actions\Admin\Groups';
    protected string $requestsPath = 'App\Http\Requests\Admin\Groups';
}

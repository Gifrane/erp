<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;

class UsersController extends BaseController
{
    protected string $actionsPath = 'App\Actions\Admin\Users';
    protected string $requestsPath = 'App\Http\Requests\Admin\Users';
}

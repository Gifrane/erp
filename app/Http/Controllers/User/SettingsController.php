<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\BaseController;

class SettingsController extends BaseController
{
    protected string $actionsPath = 'App\Actions\User\Settings';
    protected string $requestsPath = 'App\Http\Requests\User\Settings';
}
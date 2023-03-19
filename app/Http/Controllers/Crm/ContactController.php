<?php
namespace App\Http\Controllers\Crm;

use App\Http\Controllers\BaseController;

class ContactController extends BaseController
{
    protected string $actionsPath = 'App\Actions\Crm\Contact';
    protected string $requestsPath = 'App\Http\Requests\Crm\Contact';
}

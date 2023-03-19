<?php
namespace App\Http\Controllers\Bookmark;

use App\Http\Controllers\BaseController;

class BookmarkController extends BaseController
{
    protected string $actionsPath = 'App\Actions\Bookmark';
    protected string $requestsPath = 'App\Http\Requests\Bookmark';
}

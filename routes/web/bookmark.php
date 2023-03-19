<?php

use App\Http\Controllers\Bookmark\BookmarkController;

use Illuminate\Support\Facades\Route;

Route::post('add', [ BookmarkController::class, 'add' ]);
Route::post('remove', [ BookmarkController::class, 'remove' ]);
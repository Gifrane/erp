<?php

use App\Http\Controllers\Admin\ApiKeysController;
use App\Http\Controllers\Admin\CompaniesController;
use App\Http\Controllers\Admin\GroupsController;
use App\Http\Controllers\Admin\UsersController;

use Illuminate\Support\Facades\Route;

Route::prefix('api_keys')->group(function () {
    Route::view('', 'template');

    Route::post('add', [ ApiKeysController::class, 'add' ]);
    Route::post('search', [ ApiKeysController::class, 'search' ]);

    Route::post('{keys}/destroy', [ ApiKeysController::class, 'destroy' ]);
    Route::post('{keys}/edit', [ ApiKeysController::class, 'edit' ]);
});

Route::prefix('users')->group(function () {
    Route::prefix('companies')->group(function () {
        Route::view('', 'template');

        Route::post('search', [ CompaniesController::class, 'search' ]);
    });

    Route::prefix('groups')->group(function () {
        Route::view('', 'template');

        Route::post('add', [ GroupsController::class, 'add' ]);
        Route::post('search', [ GroupsController::class, 'search' ]);

        Route::post('{group}/destroy', [ GroupsController::class, 'destroy' ]);
    });

    Route::view('', 'template');

    Route::post('add', [ UsersController::class, 'add' ]);
    Route::post('search', [ UsersController::class, 'search' ]);

    Route::view('{user}', 'template');
    Route::view('{user}/modules', 'template');

    Route::post('{user}/destroy', [ UsersController::class, 'destroy' ]);
    Route::post('{user}/details', [ UsersController::class, 'details' ]);
    Route::post('{user}/details/modules', [ UsersController::class, 'detailsModules' ]);
    Route::post('{user}/edit', [ UsersController::class, 'edit' ]);
    Route::post('{user}/edit/modules', [ UsersController::class, 'editModules' ]);
    Route::post('{user}/resend_enable_mail', [ UsersController::class, 'resendEnableMail' ]);
});
<?php

use App\Http\Controllers\Crm\CompanyController;
use App\Http\Controllers\Crm\ContactController;
use App\Http\Controllers\Crm\GroupController;
use App\Http\Controllers\Crm\PipelineController;

use Illuminate\Support\Facades\Route;

Route::view('', 'template');

Route::prefix('companies')->group(function () {
    Route::view('', 'template');

    Route::post('add', [ CompanyController::class, 'add' ]);
    Route::post('search', [ CompanyController::class, 'search' ]);

    Route::middleware('user_has_crm_company')->group(function () {
        Route::view('{company}', 'template');
        Route::view('{company}/contacts', 'template');

        Route::post('{company}/destroy', [ CompanyController::class, 'destroy' ]);
        Route::post('{company}/details', [ CompanyController::class, 'details' ]);
        Route::post('{company}/edit', [ CompanyController::class, 'edit' ]);
    });
});

Route::prefix('contacts')->group(function () {
    Route::post('add', [ ContactController::class, 'add' ]);
    Route::post('add_content', [ ContactController::class, 'addContent' ]);
    Route::post('search', [ ContactController::class, 'search' ]);

    Route::middleware('user_has_crm_contact')->group(function () {
        Route::view('{contact}', 'template');
        Route::view('{contact}/mailer', 'template');
        Route::view('{contact}/reviews', 'template');

        Route::post('{contact}/destroy', [ ContactController::class, 'destroy' ]);
        Route::post('{contact}/details', [ ContactController::class, 'details' ]);
        Route::post('{contact}/edit', [ ContactController::class, 'edit' ]);
        Route::post('{contact}/edit/add/tag', [ ContactController::class, 'editAddTag' ]);

        Route::prefix('{contact}/datas')->group(function () {
            Route::view('', 'template');
        });
    });
});

Route::prefix('groups')->group(function () {
    Route::view('', 'template');

    Route::post('add', [ GroupController::class, 'add' ]);
    Route::post('search', [ GroupController::class, 'search' ]);

    Route::middleware('user_has_crm_group')->group(function () {
        Route::view('{group}', 'template');
        Route::view('{group}/contacts', 'template');

        Route::post('{group}/destroy', [ GroupController::class, 'destroy' ]);
        Route::post('{group}/details', [ GroupController::class, 'details' ]);
        Route::post('{group}/edit', [ GroupController::class, 'edit' ]);
    });
});

<?php

use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Product\SparePartsController;

use Illuminate\Support\Facades\Route;

Route::view('', 'template');

Route::post('add', [ ProductController::class, 'add' ]);
Route::post('multiple/delete', [ ProductController::class, 'multipleDelete' ]);
Route::post('search', [ ProductController::class, 'search' ]);

Route::middleware('user_has_product')->group(function () {
    Route::view('{product}', 'template');
    Route::view('{product}/options', 'template');
    Route::view('{product}/spare_parts', 'template');

    Route::post('{product}/details', [ ProductController::class, 'details' ]);
    Route::post('{product}/delete', [ ProductController::class, 'delete' ]);
    Route::post('{product}/edit', [ ProductController::class, 'edit' ]);

    Route::post('{product}/add/option', [ ProductController::class, 'addOption' ]);

    Route::post('{product}/delete/option', [ ProductController::class, 'deleteOption' ]);

    Route::post('{product}/edit/option', [ ProductController::class, 'editOption' ]);

    Route::prefix('{product}/spare_parts')->group(function () {
        Route::post('add', [ SparePartsController::class, 'add' ]);
        Route::post('details', [ SparePartsController::class, 'details' ]);
    });
});
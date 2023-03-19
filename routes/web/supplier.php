<?php

use App\Http\Controllers\Supplier\SupplierController;

use Illuminate\Support\Facades\Route;

Route::view('', 'template');

Route::post('add', [ SupplierController::class, 'add' ]);
Route::post('search', [ SupplierController::class, 'search' ]);

Route::middleware('user_has_supplier')->group(function () {
    Route::view('{supplier}', 'template');

    Route::post('{supplier}/destroy', [ SupplierController::class, 'destroy' ]);
    Route::post('{supplier}/details', [ SupplierController::class, 'details' ]);
    Route::post('{supplier}/edit', [ SupplierController::class, 'edit' ]);
});
<?php

use App\Http\Controllers\Accounting\BillingsController;

use Illuminate\Support\Facades\Route;

Route::prefix('billings')->group(function () {
    Route::view('', 'template');

    Route::post('add', [ BillingsController::class, 'add' ]);
    Route::post('search', [ BillingsController::class, 'search' ]);
});

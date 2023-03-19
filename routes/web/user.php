<?php

use App\Http\Controllers\User\SettingsController;

use Illuminate\Support\Facades\Route;

Route::prefix('profile')->group(function () {
    Route::view('{user}', 'template');
});

Route::prefix('settings')->group(function () {
    Route::view('', 'template');

    Route::post('details', [ SettingsController::class, 'details' ]);
    Route::post('send_email_reset_password', [ SettingsController::class, 'sendEmailResetPassword' ]);

    Route::prefix('update')->group(function () {
        Route::post('i18n', [ SettingsController::class, 'updateI18n' ]);
    });
});
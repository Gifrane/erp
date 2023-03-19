<?php

use App\Http\Controllers\Home\AuthController;
use App\Http\Controllers\User\UserController;

use Illuminate\Support\Facades\Route;

Route::get('check', function () {
    return 'ok';
});

Route::middleware([ 'guest' ])->group(function () {
    Route::get('auth', [ AuthController::class, 'loginGet' ])->name('auth.login.get');
    Route::post('auth', [ AuthController::class, 'loginPost' ])->name('auth.login.post');
});

Route::get('user/process/enable/{token}', [ UserController::class, 'processEnableTokenGet' ])->where('token', '.*');
Route::post('user/process/enable/{token}', [ UserController::class, 'processEnableTokenPost' ])->where('token', '.*');

Route::middleware([ 'check_user' ])->group(function () {
    Route::get('logout', [ AuthController::class, 'logout' ]);

    Route::view('', 'template')->name('app');

    Route::prefix('data')->group(__DIR__.'/web/data.php');

    Route::prefix('accounting')->group(__DIR__.'/web/accounting.php');
    Route::prefix('admin')->group(__DIR__.'/web/admin.php');
    Route::prefix('bookmark')->group(__DIR__.'/web/bookmark.php');
    Route::prefix('crm')->group(__DIR__.'/web/crm.php');
    Route::prefix('dashboard')->group(__DIR__.'/web/dashboard.php');
    Route::prefix('explorer')->group(__DIR__.'/web/explorer.php');
    Route::prefix('product')->group(__DIR__.'/web/product.php');
    Route::prefix('supplier')->group(__DIR__.'/web/supplier.php');
    Route::prefix('user')->group(__DIR__.'/web/user.php');
});

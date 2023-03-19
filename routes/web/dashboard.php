<?php

use App\Http\Controllers\Dashboard\DashboardController;

use Illuminate\Support\Facades\Route;

Route::post('content/crm', [ DashboardController::class, 'crmContent' ]);
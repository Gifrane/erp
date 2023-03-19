<?php

use App\Http\Controllers\Data\DataController;

use Illuminate\Support\Facades\Route;

Route::post('product_spare_part_details', [ DataController::class, 'productSparePartDetails' ]);
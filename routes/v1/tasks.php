<?php

declare(strict_types=1);

use App\Http\Controllers\V1\Tasks\IndexController;
use App\Http\Controllers\V1\Tasks\StoreController;
use Illuminate\Support\Facades\Route;

Route::get('/', IndexController::class)->name('index');
Route::post('/', StoreController::class)->name('store');
// update tasks
// delete

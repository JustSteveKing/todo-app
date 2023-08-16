<?php

declare(strict_types=1);

use App\Http\Controllers\V1\Tasks\IndexController;
use App\Http\Controllers\V1\Tasks\StoreController;
use App\Http\Controllers\V1\Tasks\UpdateController;
use Illuminate\Support\Facades\Route;

Route::get('/', IndexController::class)->name('index');
Route::post('/', StoreController::class)->name('store');
Route::put('{ulid}', UpdateController::class)->name('update');
// delete

// PATCH certain parts of the data in the database
// PATCH /v1/tasks/123123123123/status
// PATCH /v1/tasks/123123123123/priority
// PATCH /v1/tasks/123123123123/complete

// PUT new information into the database
// PUT /v1/tasks/123123123123

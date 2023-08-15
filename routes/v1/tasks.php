<?php

declare(strict_types=1);

use App\Http\Controllers\V1\Tasks\IndexController;
use Illuminate\Support\Facades\Route;

Route::get('/', IndexController::class)->name('index');

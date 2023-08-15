<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

Route::get('/', static fn (): array => ['ping' => time()])->name('root');

Route::prefix('v1')->as('v1:')->group(
    base_path('routes/v1/routes.php'),
);

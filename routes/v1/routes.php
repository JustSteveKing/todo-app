<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

Route::prefix('auth')->as('auth:')->group(
    base_path('routes/v1/auth.php'),
);

Route::middleware(['auth:sanctum'])->prefix('tasks')->as('tasks')->group(
    base_path('routes/v1/tasks.php'),
);

// meta endpoints for, statuses and priorities

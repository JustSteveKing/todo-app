<?php

declare(strict_types=1);

namespace App\Queries\Tasks\V1;

use App\Models\Task;
use Illuminate\Database\Eloquent\Builder;

final class GetTasksByUserId
{
    public function handle(string $id): Builder
    {
        return Task::query()->where('user_id', $id);
    }
}

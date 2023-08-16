<?php

declare(strict_types=1);

namespace App\Commands\Tasks\V1;

use App\Http\Payloads\V1\Tasks\NewTask;
use App\Models\Task;
use Illuminate\Database\DatabaseManager;
use Throwable;

final readonly class UpdateTask
{
    /**
     * @param DatabaseManager $database
     */
    public function __construct(
        private DatabaseManager $database,
    ) {}

    /**
     * @param string $task
     * @param string $category
     * @param NewTask $payload
     * @return bool
     * @throws Throwable
     */
    public function handle(string $task, string $category, NewTask $payload): bool
    {
        return $this->database->transaction(
            callback: fn () => (bool) Task::query()
                ->where('id',$task)
                ->update([
                    'title' => $payload->title,
                    'status' => $payload->status,
                    'priority' => $payload->priority,
                    'category_id' => $category,
                    'complete_at' => $payload->completed,
                ]),
            attempts: 2,
        );
    }
}

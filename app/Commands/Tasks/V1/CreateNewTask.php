<?php

declare(strict_types=1);

namespace App\Commands\Tasks\V1;

use App\Http\Payloads\V1\Tasks\NewTask;
use App\Models\Task;
use Illuminate\Database\DatabaseManager;
use Throwable;

final readonly class CreateNewTask
{
    /**
     * @param DatabaseManager $database
     */
    public function __construct(
        private DatabaseManager $database,
    ) {}

    /**
     * @param NewTask $payload
     * @param string $category
     * @param string $user
     * @return Task
     * @throws Throwable
     */
    public function handle(NewTask $payload, string $category, string $user): Task
    {
        return $this->database->transaction(
            callback: fn () => Task::query()->create([
                'title' => $payload->title,
                'status' => $payload->status,
                'priority' => $payload->priority,
                'content' => $payload->content,
                'category_id' => $category,
                'user_id' => $user,
                'complete_at' => $payload->completed,
            ]),
            attempts: 2,
        );
    }
}

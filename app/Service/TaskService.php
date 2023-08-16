<?php

declare(strict_types=1);

namespace App\Service;

use App\Commands\Tasks\V1\CreateNewCategory;
use App\Commands\Tasks\V1\CreateNewTask;
use App\Http\Payloads\V1\Tasks\NewTask;
use App\Models\Category;
use App\Models\Task;
use Throwable;

final readonly class TaskService
{
    /**
     * @param CreateNewTask $create
     * @param CreateNewCategory $createCategory
     */
    public function __construct(
        private CreateNewTask $create,
        private CreateNewCategory $createCategory,
    ) {}

    /**
     * @param NewTask $payload
     * @param string $user
     * @return Task
     * @throws Throwable
     */
    public function create(NewTask $payload, string $user): Task
    {
        return $this->create->handle(
            payload: $payload,
            category: $this->createCategory(
                name: $payload->category,
                user: $user,
            )->id,
            user: $user,
        );
    }

    /**
     * @param string $name
     * @param string $user
     * @return Category
     * @throws Throwable
     */
    public function createCategory(string $name, string $user): Category
    {
        return $this->createCategory->handle(
            name: $name,
            user: $user,
        );
    }
}

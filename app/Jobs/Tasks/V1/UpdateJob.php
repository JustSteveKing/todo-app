<?php

declare(strict_types=1);

namespace App\Jobs\Tasks\V1;

use App\Http\Payloads\V1\Tasks\NewTask;
use App\Service\TaskService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

final class UpdateJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * @param string $task
     * @param string $user
     * @param NewTask $payload
     */
    public function __construct(
        public readonly string $task,
        public readonly string $user,
        public readonly NewTask $payload,
    ) {}

    /**
     * @param TaskService $service
     * @return void
     * @throws \Throwable
     */
    public function handle(TaskService $service): void
    {
        $service->update(
            task: $this->task,
            user: $this->user,
            payload: $this->payload
        );
    }
}

<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1\Tasks;

use App\Http\Requests\V1\Tasks\StoreRequest;
use App\Http\Resources\V1\TaskResource;
use App\Http\Responses\V1\ModelResponse;
use App\Service\TaskService;
use Illuminate\Contracts\Auth\Factory;
use Illuminate\Contracts\Support\Responsable;
use JustSteveKing\Tools\Http\Enums\Status;
use Throwable;

final readonly class StoreController
{
    /**
     * @param Factory $auth
     * @param TaskService $service
     */
    public function __construct(
        private Factory $auth,
        private TaskService $service,
    ) {}

    /**
     * @param StoreRequest $request
     * @return Responsable
     * @throws Throwable
     */
    public function __invoke(StoreRequest $request): Responsable
    {
        $task = $this->service->create(
            payload: $request->payload(),
            user: (string) $this->auth->guard()->id(),
        );

        return new ModelResponse(
            data: new TaskResource(
                resource: $task,
            ),
            status: Status::CREATED,
        );
    }
}

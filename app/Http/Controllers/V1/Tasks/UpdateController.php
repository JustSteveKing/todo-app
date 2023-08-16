<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1\Tasks;

use App\Http\Requests\V1\Tasks\StoreRequest;
use App\Http\Responses\V1\MessageResponse;
use App\Jobs\Tasks\V1\UpdateJob;
use App\Models\Task;
use Illuminate\Contracts\Auth\Factory;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use JustSteveKing\Tools\Http\Enums\Status;
use Throwable;

final readonly class UpdateController
{
    /**
     * @param Factory $auth
     */
    public function __construct(
        private Factory $auth,
    ) {}

    /**
     * @param StoreRequest $request
     * @param string $ulid
     * @return Responsable
     * @throws Throwable
     */
    public function __invoke(StoreRequest $request, string $ulid): Responsable
    {
        if (! Task::query()->where('id', $ulid)->exists()) {
            throw new ModelNotFoundException(
                message: "No task found for [$ulid]",
                code: Status::NOT_FOUND->value,
            );
        }

        \dispatch(new UpdateJob(
            task: $ulid,
            user: (string) $this->auth->guard()->id(),
            payload: $request->payload(),
        ));

        return new MessageResponse(
            data: [
                'message' => 'We are processing your request.',
            ],
            status: Status::ACCEPTED,
        );
    }
}

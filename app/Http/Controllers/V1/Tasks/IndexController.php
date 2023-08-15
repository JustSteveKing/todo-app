<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1\Tasks;

use App\Http\Resources\V1\TaskResource;
use App\Http\Responses\V1\CollectionResponse;
use App\Queries\Tasks\V1\GetTasksByUserId;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;

final readonly class IndexController
{
    public function __construct(
        private Authenticatable $auth,
        private GetTasksByUserId $query,
    ) {}

    public function __invoke(Request $request): Responsable
    {
        return new CollectionResponse(
            data: TaskResource::collection(
                resource: $this->query->handle(
                    id: \strval($this->auth->getAuthIdentifier()),
                )->paginate(),
            ),
        );
    }
}

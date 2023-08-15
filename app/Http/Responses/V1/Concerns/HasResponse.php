<?php

declare(strict_types=1);

namespace App\Http\Responses\V1\Concerns;

use App\Http\Factories\HeaderFactory;
use Illuminate\Http\JsonResponse;
use JustSteveKing\Tools\Http\Enums\Status;

/**
 * @property mixed $data
 * @property Status $status
 */
trait HasResponse
{
    public function toResponse($request): JsonResponse
    {
        return new JsonResponse(
            data: $this->data,
            status: $this->status->value,
            headers: HeaderFactory::default(),
        );
    }
}

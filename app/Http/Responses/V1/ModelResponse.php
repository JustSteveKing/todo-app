<?php

declare(strict_types=1);

namespace App\Http\Responses\V1;

use App\Http\Responses\V1\Concerns\HasResponse;
use Illuminate\Contracts\Support\Responsable;
use JustSteveKing\Tools\Http\Enums\Status;
use TiMacDonald\JsonApi\JsonApiResource;

final class ModelResponse implements Responsable
{
    use HasResponse;

    public function __construct(
        protected readonly JsonApiResource $data,
        protected readonly Status $status = Status::OK,
    ) {}
}

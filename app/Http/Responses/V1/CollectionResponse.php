<?php

declare(strict_types=1);

namespace App\Http\Responses\V1;

use App\Http\Responses\V1\Concerns\HasResponse;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use JustSteveKing\Tools\Http\Enums\Status;

final readonly class CollectionResponse implements Responsable
{
    use HasResponse;

    public function __construct(
        private AnonymousResourceCollection $data,
        private Status $status = Status::OK,
    ) {}
}

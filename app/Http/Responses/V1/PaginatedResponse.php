<?php

declare(strict_types=1);

namespace App\Http\Responses\V1;

use App\Http\Responses\V1\Concerns\HasResponse;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Pagination\AbstractPaginator;
use JustSteveKing\Tools\Http\Enums\Status;

final readonly class PaginatedResponse implements Responsable
{
    use HasResponse;

    public function __construct(
        protected AbstractPaginator $data,
        protected Status $status = Status::OK,
    ) {}
}

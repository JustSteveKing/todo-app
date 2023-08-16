<?php

declare(strict_types=1);

namespace App\Http\Responses\V1;

use App\Http\Responses\V1\Concerns\HasResponse;
use Illuminate\Contracts\Support\Responsable;
use JustSteveKing\Tools\Http\Enums\Status;

final class MessageResponse implements Responsable
{
     use HasResponse;

    /**
     * @param array{message:string} $data
     * @param Status $status
     */
     public function __construct(
         protected readonly array $data,
         protected readonly Status $status = Status::OK,
     ) {}
}

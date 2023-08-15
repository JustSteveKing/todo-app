<?php

declare(strict_types=1);

namespace App\Http\Responses\V1\Auth;

use App\Http\Factories\HeaderFactory;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use JustSteveKing\Tools\Http\Enums\Status;
use Laravel\Sanctum\NewAccessToken;

final readonly class TokenResponse implements Responsable
{
    public function __construct(
        private NewAccessToken $data,
        private Status $status = Status::OK,
    ) {}

    public function toResponse($request): JsonResponse
    {
        return new JsonResponse(
            data: [
                'token' => $this->data->plainTextToken,
            ],
            status: $this->status->value,
            headers: HeaderFactory::v1(),
        );
    }
}

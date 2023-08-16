<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1\Auth;

use App\Http\Requests\V1\Auth\RegistrationRequest;
use App\Http\Responses\V1\Auth\TokenResponse;
use App\Service\AuthService;
use Illuminate\Contracts\Auth\Factory;
use Illuminate\Contracts\Support\Responsable;
use JustSteveKing\Tools\Http\Enums\Status;
use Throwable;

final class RegistrationController
{
    public function __construct(
        private AuthService $service,
    ) {}

    /**
     * @param RegistrationRequest $request
     * @return Responsable
     * @throws Throwable
     */
    public function __invoke(RegistrationRequest $request): Responsable
    {
        return new TokenResponse(
            data: $this->service->register(
                payload: $request->payload(),
                name: (string) $request->userAgent(),
            ),
            status: Status::CREATED,
        );
    }
}

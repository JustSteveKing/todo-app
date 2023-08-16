<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1\Auth;

use App\Exceptions\V1\Auth\AuthenticationException;
use App\Http\Requests\V1\Auth\LoginRequest;
use App\Http\Responses\V1\Auth\TokenResponse;
use App\Service\AuthService;
use Illuminate\Contracts\Auth\Factory;
use Illuminate\Contracts\Support\Responsable;
use JustSteveKing\Tools\Http\Enums\Status;

final readonly class LoginController
{
    public function __construct(
        private Factory $auth,
        private AuthService $service,
    ) {}

    /**
     * @param LoginRequest $request
     * @return Responsable
     * @throws AuthenticationException
     */
    public function __invoke(LoginRequest $request): Responsable
    {
        if (! $this->auth->guard()->attempt($request->only('email','password'))) {
            throw new AuthenticationException(
                message: 'Failed authentication, please check your credentials.',
                code: Status::UNAUTHORIZED->value,
            );
        }

        return new TokenResponse(
            data: $this->service->createToken(
                id: (string) $this->auth->guard()->id(),
                name: (string) $request->userAgent(),
            ),
        );
    }
}

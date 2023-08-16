<?php

declare(strict_types=1);

namespace App\Service;

use App\Commands\Auth\V1\CreateNewUser;
use App\Commands\Auth\V1\CreateTokenForUser;
use App\Http\Payloads\V1\Auth\NewUser;
use App\Models\User;
use Illuminate\Contracts\Auth\Factory;
use Laravel\Sanctum\NewAccessToken;
use Throwable;

final readonly class AuthService
{
    /**
     * @param Factory $auth
     * @param CreateNewUser $user
     * @param CreateTokenForUser $token
     */
    public function __construct(
        private Factory $auth,
        private CreateNewUser $user,
        private CreateTokenForUser $token,
    ) {}

    /**
     * @param NewUser $payload
     * @return User
     * @throws Throwable
     */
    public function createUser(NewUser $payload): User
    {
        return $this->user->handle(
            payload: $payload,
        );
    }

    /**
     * @param string $id
     * @param string $name
     * @return NewAccessToken
     */
    public function createToken(string $id, string $name): NewAccessToken
    {
        return $this->token->handle(
            id: $id,
            name: $name,
        );
    }

    /**
     * @param NewUser $payload
     * @param string $name
     * @return NewAccessToken
     * @throws Throwable
     */
    public function register(NewUser $payload, string $name): NewAccessToken
    {
        $user = $this->createUser(
            payload: $payload,
        );

        $this->auth->guard()->loginUsingId(
            id: $user->id,
        );

        return $this->createToken(
            id: $user->id,
            name: $name,
        );
    }
}

<?php

declare(strict_types=1);

namespace App\Commands\Auth\V1;

use App\Models\User;
use Laravel\Sanctum\NewAccessToken;

final class CreateTokenForUser
{
    public function handle(string $id, string $name): NewAccessToken
    {
        /** @var User $user */
        $user = User::query()->findOrFail(
            id: $id,
        );

        return $user->createToken(
            name: $name,
        );
    }
}

<?php

declare(strict_types=1);

namespace App\Commands\Auth\V1;

use App\Http\Payloads\V1\Auth\NewUser;
use App\Models\User;
use Illuminate\Database\DatabaseManager;
use Throwable;

final readonly class CreateNewUser
{
    /**
     * @param DatabaseManager $database
     */
    public function __construct(
        private DatabaseManager $database,
    ) {}

    /**
     * @param NewUser $payload
     * @return User
     * @throws Throwable
     */
    public function handle(NewUser $payload): User
    {
        return $this->database->transaction(
            callback: fn () => User::query()->create($payload->toArray()),
            attempts: 2,
        );
    }
}

<?php

declare(strict_types=1);

namespace App\Commands\Tasks\V1;

use App\Models\Category;
use Illuminate\Database\DatabaseManager;
use Throwable;

final readonly class CreateNewCategory
{
    /**
     * @param DatabaseManager $database
     */
    public function __construct(
        private DatabaseManager $database,
    ) {}

    /**
     * @param string $name
     * @param string $user
     * @return Category
     * @throws Throwable
     */
    public function handle(string $name, string $user): Category
    {
        return $this->database->transaction(
            callback: fn () => Category::query()->updateOrCreate([
                'name' => $name,
                'user_id' => $user,
            ]),
            attempts: 2,
        );
    }
}

<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;

final class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::factory()->create([
            'name' => 'Steve',
            'email' => 'juststevemcd@gmail.com',
        ]);

        Task::factory()->for($user)->count(20)->create();
    }
}

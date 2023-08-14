<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\Priority;
use App\Enums\Status;
use App\Models\Category;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

final class TaskFactory extends Factory
{
    protected $model = Task::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'status' => Status::OPEN,
            'priority' => Priority::MEDIUM,
            'content' => $this->faker->realText(),
            'category_id' => Category::factory(),
            'user_id' => User::factory(),
            'complete_at' => $this->faker->boolean()
                ? now()->addDays($this->faker->randomDigitNotNull())
                : null,
        ];
    }
}

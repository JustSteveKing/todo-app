<?php

declare(strict_types=1);

namespace App\Providers;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\ServiceProvider;

final class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Relation::enforceMorphMap(
            map: [
                'user' => User::class,
            ],
        );

        Model::shouldBeStrict(
            shouldBeStrict: ! $this->app->environment('production'),
        );

        JsonResource::withoutWrapping();
    }
}

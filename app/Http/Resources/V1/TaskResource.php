<?php

declare(strict_types=1);

namespace App\Http\Resources\V1;

use App\Http\Resources\DateResource;
use App\Models\Task;
use Illuminate\Http\Request;
use TiMacDonald\JsonApi\JsonApiResource;

/**
 * @property-read Task $resource
 */
final class TaskResource extends JsonApiResource
{
    public function toAttributes(Request $request): array
    {
        return [
            'title' => $this->resource->title,
            'priority' => $this->resource->priority->value,
            'status' => $this->resource->status->value,
            'content' => $this->resource->content,
            'completed' => new DateResource(
                resource: $this->resource->complete_at,
            ),
        ];
    }
}

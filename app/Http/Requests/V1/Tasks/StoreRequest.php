<?php

declare(strict_types=1);

namespace App\Http\Requests\V1\Tasks;

use App\Enums\Priority;
use App\Enums\Status;
use App\Http\Payloads\V1\Tasks\NewTask;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;

final class StoreRequest extends FormRequest
{
    /**
     * @return array<string,array>
     */
    public function rules(): array
    {
        return [
            'title' => [
                'required',
                'string',
                'min:2',
                'max:255',
            ],
            'status' => [
                'nullable',
                Rule::enum(
                    type: Status::class,
                ),
            ],
            'priority' => [
                'nullable',
                Rule::enum(
                    type: Priority::class,
                ),
            ],
            'content' => [
                'nullable',
                'string',
            ],
            'category' => [
                'required',
                'string',
                'min:2',
                'max:255',
            ],
            'completed' => [
                'nullable',
                'date',
            ]
        ];
    }

    public function payload(): NewTask
    {
        return NewTask::fromRequest(
            data: [
                'title' => $this->string('title')->toString(),
                'status' => $this->has('status') ? Status::from(
                    value: $this->string('status')->toString(),
                ) : null,
                'priority' => $this->has('priority') ? Priority::from(
                    value: $this->string('priority')->toString(),
                ) : null,
                'content' => $this->string('content')->toString(),
                'category' => $this->string('category')->toString(),
                'completed' => $this->has('completed') ? Carbon::parse(
                    time: $this->string('completed')->toString(),
                ) : null,
            ],
        );
    }
}

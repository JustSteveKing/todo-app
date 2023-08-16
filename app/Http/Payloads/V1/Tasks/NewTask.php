<?php

declare(strict_types=1);

namespace App\Http\Payloads\V1\Tasks;

use App\Enums\Priority;
use App\Enums\Status;
use Carbon\CarbonInterface;

final readonly class NewTask
{
    public function __construct(
        public string $title,
        public null|Status $status,
        public null|Priority $priority,
        public null|string $content,
        public string $category,
        public null|CarbonInterface $completed,
    ) {}

    /**
     * @param array{title:string,status:null|Status,priority:null|Priority,content:null|string,category:string,completed:null|CarbonInterface} $data
     * @return NewTask
     */
    public static function fromRequest(array $data): NewTask
    {
        return new NewTask(
            title: $data['title'],
            status: $data['status'],
            priority: $data['priority'],
            content: $data['content'],
            category: $data['category'],
            completed: $data['completed']
        );
    }
}

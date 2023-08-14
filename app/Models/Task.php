<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\Priority;
use App\Enums\Status;
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string $id
 * @property string $title
 * @property Status $status
 * @property Priority $priority
 * @property string $content
 * @property string $category_id
 * @property string $user_id
 * @property null|CarbonInterface $complete_at
 * @property null|CarbonInterface $created_at
 * @property null|CarbonInterface $updated_at
 * @property Category $category
 * @property User $user
 */
final class Task extends Model
{
    use HasFactory;
    use HasUlids;

    protected $fillable = [
        'title',
        'status',
        'priority',
        'content',
        'category_id',
        'user_id',
        'complete_at',
    ];

    protected $casts = [
        'status' => Status::class,
        'priority' => Priority::class,
        'complete_at' => 'datetime',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(
            related: Category::class,
            foreignKey: 'category_id',
        );
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(
            related: User::class,
            foreignKey: 'user_id',
        );
    }
}

<?php

declare(strict_types=1);

namespace App\Enums;

enum Status: string
{
    case OPEN = 'open';
    case IN_PROGRESS = 'in progress';
    case COMPLETE = 'complete';
}

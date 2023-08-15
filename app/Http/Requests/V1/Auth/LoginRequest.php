<?php

declare(strict_types=1);

namespace App\Http\Requests\V1\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class LoginRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => [
                'required',
                'email',
                Rule::exists(
                    table: 'users',
                    column: 'email',
                ),
            ],
            'password' => [
                'required',
                'string',
            ]
        ];
    }
}

<?php

declare(strict_types=1);

namespace App\Http\Requests\V1\Auth;

use App\Http\Payloads\V1\Auth\NewUser;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rules\Unique;

final class RegistrationRequest extends FormRequest
{
    /**
     * @return array<int,Password|Unique|string|array>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'min:2',
                'max:255',
            ],
            'email' => [
                'required',
                'email',
                Rule::unique(
                    table: 'users',
                    column: 'email',
                )
            ],
            'password' => [
                'required',
                'string',
                Password::default(),
            ]
        ];
    }

    public function payload(): NewUser
    {
        return NewUser::fromRequest(
            data: [
                'name' => $this->string('name')->toString(),
                'email' => $this->string('email')->toString(),
                'password' => Hash::make(
                    value: $this->string('password')->toString(),
                ),
            ],
        );
    }
}

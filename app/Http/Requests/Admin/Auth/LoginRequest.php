<?php

namespace App\Http\Requests\Admin\Auth;

use App\Http\Requests\BaseRequest;

class LoginRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'email' => [
                'required', 'email'
            ],
            'password' => [
                'required'
            ]
        ];
    }
}

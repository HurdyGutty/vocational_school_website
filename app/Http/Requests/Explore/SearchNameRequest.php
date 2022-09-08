<?php

namespace App\Http\Requests\Explore;

use App\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class SearchNameRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'name' => [
                'bail',
                'nullable',
                'string',
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'string' => ':attribute phải bao gồm chữ',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Tên',
        ];
    }
}
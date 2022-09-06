<?php

namespace App\Http\Requests\Explore;

use App\Http\Requests\BaseRequest;

class SearchRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'major_name' => [
                'bail',
                'nullable',
                'string',
            ]
        ];
    }
    public function messages(): array
    {
        return [
            'string' => ':attribute phải là chữ',
        ];
    }
    public function attributes()
    {
        return [
            'search' => 'Tìm kiếm',
        ];
    }
}
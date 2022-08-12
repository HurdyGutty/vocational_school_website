<?php

namespace App\Http\Requests;

use phpDocumentor\Reflection\Types\Nullable;

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
            'search' => [
                'nullable',
                'string',
            ]
        ];
    }
    public function messages():array
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
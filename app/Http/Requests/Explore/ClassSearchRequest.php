<?php

namespace App\Http\Requests\Explore;

use App\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class ClassSearchRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'weekday' => [
                'bail',
                'nullable',
                'integer',
                'required_with:time',
                'between:0,6',
            ],
            'time' => [
                'bail',
                'nullable',
                'integer',
                'required_with:weekday',
                'between:1,2',
            ],
            'teacher_name' => [
                'bail',
                'nullable',
                'string',
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'integer' => ':attribute phải trong lựa chọn',
            'string' => ':attribute phải bao gồm chữ',
            'between' => ':attribute phải trong lựa chọn',
            'required_with' => 'Phải chọn thứ cùng với ca',
        ];
    }

    public function attributes()
    {
        return [
            'weekday' => 'Thứ',
            'time' => 'Ca',
            "teacher_name" => 'Tên giáo viên',
        ];
    }
}
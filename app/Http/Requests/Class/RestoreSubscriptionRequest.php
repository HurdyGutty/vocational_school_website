<?php

namespace App\Http\Requests\Class;

use App\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RestoreSubscriptionRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'class_id' =>
            [
                'required',
                'integer',
                Rule::exists('classes', 'id')
            ],
            'student_id' =>
            [
                'required',
                'integer',
                Rule::exists('users', 'id')
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'required' => ':attribute bắt buộc phải điền',
            'integer' => ':attribute phải là số',
            'exists' => ':attribute không có trong danh sách',
        ];
    }

    public function attributes()
    {
        return [
            'class_id' => 'Lớp',
            "student_id" => 'Học sinh',
        ];
    }
}
<?php

namespace App\Http\Requests\Class;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DeleteSubscription extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
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
    protected function prepareForValidation()
    {
        $this->merge([
            'class_id' => $this->route('class_id'),
            "student_id" => $this->route('student_id'),
        ]);
    }
}
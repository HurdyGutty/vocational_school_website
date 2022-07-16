<?php

namespace App\Http\Requests\Subject;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            "id" => [
                'bail',
                'required',
                'integer',
            ],
            "name" => [
                'bail',
                'required',
                'string',
            ],
            "description" => [
                'max:1000',
                'nullable',
                'bail',
            ],
            "time_duration" => [
                'integer',
                'nullable',
                'bail',
            ],
            "image" => [
                'bail',
                'image',
                'nullable',
            ],
        ];
    }
    public function messages():array
    {
        return [
            'required' => ':attribute bắt buộc phải điền',
            'unique'=> ':attribute bị trùng',
            'integer' => ':attribute phải là số',
            'string' => ':attribute phải là chữ',
            'exists' => ':attribute không có trong danh sách',
            'image' => ':attribute không đúng định dạng',
            'max' => ':attribute quá 1000 ký tự'
        ];
    }
    public function attributes()
    {
    return [
        'name' => 'Tên môn',
        "description" => 'Mô tả',
        "time_duration" => 'Thời gian',
        "image" => 'Ảnh',
    ];
    }
}
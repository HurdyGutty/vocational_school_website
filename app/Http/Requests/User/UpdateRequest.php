<?php

namespace App\Http\Requests\User;

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
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "name" => [
                'bail',
                'required',
                'string',
            ],
            "gender" => [
                'boolean',
                'required',
                'bail',
            ],
            "date_of_birth" => [
                'date',
                'required',
                'bail',
            ],
            "phone" => [
                'string',
                'max:17',
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
        ];
    }
    public function attributes()
    {
    return [
        'name' => 'Tên môn',
        "gender" => 'Giới tính',
        "date_of_birth" => 'Ngày sinh',
        "phone" => 'Số điện thoại',
        "image" => 'Ảnh',
    ];
    }
}
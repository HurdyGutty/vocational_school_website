<?php

namespace App\Http\Requests\Major;

use App\Models\Image;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
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
            "name" => [
                'bail',
                'required',
                'string',
                'unique:majors,name'
            ],
            "description" => [
                'string',
                'nullable',
                'bail',
            ],
            "time_duration" => [
                'integer',
                'nullable',
                'bail',
            ],
            "courses" => [
                'integer',
                'nullable',
                'bail',
            ],
            "image_id" => [
                'integer',
                'bail',
                'nullable',
                Rule::exists(Image::class, 'id'),
            ],

            
        ];
    }
    public function messages():array
    {
        return [
            'required' => ':attribute bắt buộc phải điền',
            'unique'=> ':attribute bị trùng',
            'integer' => ':attribute phải nhập số',
            'string' => ':attribute phải nhập chữ',
            'exists' => ':attribute không có trong danh sách',
        ];
    }
    public function attributes()
    {
    return [
        'name' => 'Tên ngành',
        "description" => 'Mô tả',
        "time_duration" => 'Thời gian',
        "courses" => 'Số buổi',
        "image_id" => 'Ảnh',
    ];
    }
}
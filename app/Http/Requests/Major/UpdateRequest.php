<?php

namespace App\Http\Requests\Major;

use App\Models\Image;
use App\Models\Subject;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            "subjects.*" => [
                'bail',
                'required',
                'integer',
                Rule::exists(Subject::class, 'id'),
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
        ];
    }
    public function attributes()
    {
    return [
        'id' => 'Mã',
        'name' => 'Tên ngành',
        "description" => 'Mô tả',
        "time_duration" => 'Thời gian',
        "courses" => 'Số buổi',
        "image_id" => 'Ảnh',
        "subjects.*" => 'Môn'
    ];
    }
    protected function prepareForValidation() 
    {
        $this->merge([
            'subjects' => explode(',',$this->subjects),
        ]);
    }
}
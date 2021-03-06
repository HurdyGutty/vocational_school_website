<?php

namespace App\Http\Requests\Major;

use App\Models\Image;
use App\Models\Subject;
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
                'max:1000',
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
            "image" => [
                'bail',
                'image',
                'nullable',
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
            'image' => ':attribute không đúng định dạng',
            'max' => ':attribute quá 1000 ký tự'
        ];
    }
    public function attributes()
    {
    return [
        'name' => 'Tên ngành',
        "description" => 'Mô tả',
        "time_duration" => 'Thời gian',
        "courses" => 'Số buổi',
        "image" => 'Ảnh',
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
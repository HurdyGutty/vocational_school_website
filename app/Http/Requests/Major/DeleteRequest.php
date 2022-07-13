<?php

namespace App\Http\Requests\Major;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DeleteRequest extends FormRequest
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
            'id' => [
                'required',
                'bail',
                'integer',
                Rule::exists('majors','id'),
            ]
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
        return[
            'id' =>'Mã',
        ];
    }
    protected function prepareForValidation() 
    {
        $this->merge(['id' => $this->route('major.id')]);
    }
}
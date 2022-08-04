<?php

namespace App\Http\Requests\User\Class;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class storeClassRequest extends FormRequest
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
            'subject' => [
                'bail',
                'required',
                'integer',
                Rule::exists('subjects','id'),
            ],
            'weekday1' => [
                'bail',
                'required_without:weekday2',
                'integer',
                'min:0',
                'max:6',
                'nullable',
            ],
            'weekday2' => [
                'bail',
                'required_without:weekday1',
                'integer',
                'min:0',
                'max:6',
                'nullable',
            ],
            'time1' => [
                'bail',
                'required_with:weekday1',
                'integer',
                'min:1',
                'max:2',
                'nullable',
            ],
            'time2' => [
                'bail',
                'required_with:weekday2',
                'integer',
                'min:1',
                'max:2',
                'nullable',
            ],
        ];
    }

    public function messages():array
    {
        return [
            'required' => ':attribute bắt buộc phải điền',
            'required_with' => ':attribute bắt buộc đi cùng với thứ',
            'required_without' => ':attribute không được trùng',
            'integer' => 'Bạn phải chọn trong danh sách',
            'min' => 'Bạn phải chọn trong danh sách',
            'max' => 'Bạn phải chọn trong danh sách',
            'exists' => ':attribute không có trong danh sách',
        ];
    }

    public function attributes()
    {
    return [
        'subject' => 'Môn',
        "weekday1" => 'Thứ',
        "weekday2" => 'Thứ',
        "time1" => 'Ca',
        "time2" => 'Ca',
    ];
    }
}
<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\BaseRequest;

class RegisterRequest extends BaseRequest
{

    public function rules(): array
    {
        return [
            "name" => [
                'bail',
                'required',
                'string',
            ],
            "gender" => [
                'bail',
                'required',
                'boolean',
            ],
            "date_of_birth" => [
                'bail',
                'required',
                'date_format:d/m/Y',
            ],
            "phone" => [
                'bail',
                'nullable',
                'string',
                'regex:/\(?(\+|00)?([0-9]{0,4})([ .-]?)([0-9]{0,4})([ .-]?)([0-9]{2})\)?([ .-]?)([0-9]{3})([ .-]?)([0-9]{4})/'
            ],
            'email' => [
                'bail',
                'required',
                'string',
                'regex:/^[\w\-\.]+@(?:[\w-]+\.)+[\w-]{2,4}$/'
            ],
            'password' => [
                'bail',
                'required',
                'string',
                'regex:/^(?=.*[A-Z])(?=.*[0-9])(?=.*[a-z]).{8,}$/',
            ],
            'password_confirmation' => [
                'bail',
                'required',
                'string',
                'same:password',
            ],
            'image' => [
                'bail',
                'image',
                'nullable',
                'dimensions:ratio=1/1',
            ],
            "teacher_role" => [
                'bail',
                'nullable',
                'boolean',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'required' => ':attribute bắt buộc phải điền',
            'boolean' => ':attribute chọn sai',
            'date' => ':attribute phải là ngày tháng hợp lệ',
            'string' => ':attribute không có ký tự chữ',
            'phone.string' => 'Số điện thoại không đúng định dạng',
            'phone.regex' => 'Bạn nhập sai định dạng số điện thoại',
            'email.regex' => 'Bạn nhập sai định dạng email',
            'password.regex' => 'Bạn phải nhập mật khẩu có ít nhất 8 ký tự gồm 1 chữ in hoa, 1 chữ in thường và 1 số',
            'password_confirmation.same' => 'Bạn phải lặp lại đúng mật khẩu',
            'image' => ':attribute không đúng định dạng hình',
            'dimensions' => ':attribute phải là hỉnh vuông',
        ];
    }
    public function attributes()
    {
        return [
            'name' => 'Họ tên',
            'gender' => 'Giới tính',
            'date_of_birth' => 'Ngày sinh',
            'phone' => 'Số điện thoại',
            'email' => 'Email',
            'password' => 'Mật khẩu',
            'password_confirmation' => 'Mật khẩu',
            "image" => 'Ảnh',
            'teacher_role' => 'Đăng ký làm giáo viên'
        ];
    }
}
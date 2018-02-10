<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserValidator extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:200',
            'email' => 'required|string|email|max:200|unique:users',
            'password' => 'required|string|min:8',
            'mobile1' => 'required|unique:users',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'يجب ادخل اسم المستخدم',
            'email.required' => 'يجب ادخل بريد الكترونى',
            'email.unique' => 'هذا البريد الالكترونى تم استخدامه من قبل',
            'password.required' => 'يجب ادخل كلمة مرور',
            'mobile1.required' => 'يجب ادخل رقم الجوال',
            'mobile1.unique' => 'هذا الجوال تم استخدامه من قبل',
        ];
    }
}

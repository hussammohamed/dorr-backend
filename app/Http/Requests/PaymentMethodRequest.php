<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentMethodRequest extends FormRequest
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
            'name_ar' => 'required',
            'name_en' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name_ar.required' => 'يجب ادخل اسم باللغة العربية',
            'name_en.required' => 'يجب ادخل اسم باللغة الانجليزية',
        ];
    }
}

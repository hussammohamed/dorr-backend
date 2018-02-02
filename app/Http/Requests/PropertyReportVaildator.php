<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PropertyReportVaildator extends FormRequest
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
            'property_id' => 'required',
            'comment' => 'required',
            'user_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'property_id.required' => 'يجب تحديد عقار',
            'comment.required' => 'يجب ادخل تعليق للعرض',
            'user_id.required' => 'يجب تحديد مستخدم',
        ];
    }
}

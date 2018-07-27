<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PropertyOfferRequest extends FormRequest
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
            'description' => 'required',
            //'price' => 'required',
            'user_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'property_id.required' => 'يجب تحديد عقار',
            'description.required' => 'يجب ادخل تعليق للعرض',
            //'price.required' => 'يجب ادخل سعر للعرض',
            'user_id.required' => 'يجب تحديد مستخدم',
        ];
    }
}

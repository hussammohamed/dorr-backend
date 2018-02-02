<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegionVaildator extends FormRequest
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
            'name_en' => 'required',
            'region_id' => 'required',
            'type' => 'required',
            'lat' => 'required',
            'long' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name_ar.required' => 'يجب ادخل اسم باللغة العربية للنوع',
            'name_en.required' => 'يجب ادخل اسم باللغة الانجليزية للنوع',
            'region_id.required' => 'يجب اختيار من القائمة',
            'type.required' => 'يجب اختيار نوع للحى',
            'lat.required'  => 'يجب تحديد نقطة على الخريطة',
            'long.required'  => 'يجب تحديد نقطة على الخريطة',
        ];
    }
}

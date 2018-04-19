<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IdTypeRequest extends FormRequest
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
            'name_ar' => 'required|unique:banks|min:2|max:30',
            'name_en' => 'required|unique:banks|min:2|max:30'
        ];
    }

    public function messages()
    {
        return [
            'name_ar.required' => 'يجب ادخل الاسم',
            'name_ar.unique' => 'يجب ان يكون الاسم غير مكرر',
            'name_ar.min' => 'اقل عدد للاحرف هو حرفان',
            'name_ar.max' => 'اقصى عدد للاحرف هو 30 حرف',
            'name_en.required' => 'Name is required',
            'name_en.unique' => 'Name must be unique',
            'name_en.min' => 'Name must be more than 2 letters',
            'name_en.max' => 'Name must be less than 30 letters',
        ];
    }
}

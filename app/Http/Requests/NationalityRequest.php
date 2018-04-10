<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NationalityRequest extends FormRequest
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
            'name' => 'required|unique:banks|min:2|max:30'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'يجب ادخل الاسم',
            'name.unique' => 'يجب ان يكون الاسم غير مكرر',
            'name.min' => 'اقل عدد للاحرف هو حرفان',
            'name.max' => 'اقصى عدد للاحرف هو 30 حرف',
        ];
    }
}

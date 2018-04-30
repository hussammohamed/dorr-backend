<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AgencyRequest extends FormRequest
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
		    'user_id' => 'required',
            'commercial_register_name' => 'required',
            'commercial_register_no' => 'required',
            'commercial_register_address' => 'required',
		    'commercial_register_issuer' => 'required',
		    'commercial_register_date' => 'required',
            'commercial_register_exp_date' => 'required',
            'commercial_register_image' => 'required',
        ];
    }

    public function messages()
    {
        return [
		    'user_id.required' => 'يجب ادخل مستخدم',
            'commercial_register_name.required' => 'يجب ادخل الاسم',
            'commercial_register_no.required' => 'يجب ادخل رقم السجل التجارى',
            'commercial_register_address.required' => 'يجب ادخل العنوان',
		    'commercial_register_issuer.required' => 'يجب ادخل مكان الاصدار',
		    'commercial_register_date.required' => 'يجب ادخل تاريخ الاصدار',
            'commercial_register_exp_date.required' => 'يجب ادخل تاريخ الانتهاء',
            'commercial_register_image.required' => 'يجب ادخل صورة السجل التجارى'
        ];
    }
}

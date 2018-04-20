<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UnitRequest extends FormRequest
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
            'name' => 'required',
            'type'=> 'required',
            'floor' => 'required',
            'furnished' => 'required',
            'furnished_status' => 'required',
            'kitchen_cabinet' => 'required',
            'bed_rooms' => 'required',
            'living_rooms' => 'required',
            'reception_rooms' => 'required',
            'bath_rooms' => 'required',
            'split_air_conditioner' => 'required',
            'window_air_conditioner' => 'required',
            'electricity_meter' => 'required',
            'water_meter' => 'required',
            'gas_meter' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'يجب ادخال اسم',
            'type.required' => 'يجب ادخال نوع',
            'floor.required' => 'يجب ادخال رقم الدور',
            'furnished.required' => 'يجب اختيار ان كانت مؤثثة ام لا',
            'furnished_status.required' => 'يجب اختيار حالة التأثيث',
            'kitchen_cabinet.required' => 'يجب اختيار ان كانت تحتوى على مطبخ ام لا',
            'bed_rooms.required' => 'يجب ادخال عدد غرف النوم',
            'living_rooms.required' => 'يجب ادخال عدد غرف المعيشة',
            'reception_rooms.required' => 'يجب ادخال عدد غرف الاستقبال',
            'bath_rooms.required' => 'يجب ادخال عدد الحمامات',
            'split_air_conditioner.required' => 'يجب ادخال عدد التكيفات',
            'window_air_conditioner.required' => 'يجب ادخال عدد التكيفات الشباك',
            'electricity_meter.required' => 'يجب ادخال رقم عداد الكهرباء',
            'water_meter.required' => 'يجب ادخال رقم عداد الماء',
            'gas_meter.required' => 'يجب ادخال رقم عداد الغاز'
        ];
    }
}

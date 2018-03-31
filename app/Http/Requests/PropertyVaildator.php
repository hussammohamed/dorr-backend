<?php

namespace App\Http\Requests;

use App\Rules\ValidYouTube;

use Illuminate\Foundation\Http\FormRequest;

class PropertyVaildator extends FormRequest
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
            'type' => 'required',
            'purpose' => 'required',
            'address' => 'required',
            'region' => 'required',
            'lat' => 'required',
            'long' => 'required',
            'price' => 'required',
            //'advertiser_type' => 'required',
            //'area' => 'required|numeric',
            'rooms' => 'numeric',
            'bathrooms' => 'numeric',
            //'youtube' => ['url', new ValidYouTube],
        ];
    }

    public function messages()
    {
        return [
            'type.required' => 'يجب اختيار نوع للعقار',
            'purpose.required' => 'يجب اختيار الغرض من الاعلان',
            'title.required' => 'يجب ادخال عنوان للاعلان',
            'address.required' => 'يجب ادخال عنوان للعقار',
            'region.required' => 'يجب اختيار حى',
            'lat.required'  => 'يجب تحديد نقطة على الخريطة',
            'long.required'  => 'يجب تحديد نقطة على الخريطة',
            'price.required' => 'يجب ادخال سعر العقار',
            //'advertiser_type.required' => 'يجب ادخال علاقتك بلاعلان',
            //'area.required' => 'يجب ادخال مساحة العقار',
            //'area.numeric' => 'المساحة يجب ان تكون رقما',
            'rooms.numeric' => 'عدد الغرف يجب ان يكون رقما',
            'bathrooms.numeric' => 'عدد الحمامات يجب ان يكون رقما',
        ];
    }
}

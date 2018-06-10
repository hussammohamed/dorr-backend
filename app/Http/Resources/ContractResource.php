<?php

namespace App\Http\Resources;

use App;
use App\Http\Controllers\CalendarController;
use App\ContractUnit;

use App\Http\Resources\ContractUnitResource;
use Illuminate\Http\Resources\Json\Resource;


class ContractResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        
        $name = 'name_'.App::getLocale();
        return [
            'id' => $this->id,
            'contract_condition' => $this->contract_condition,
            'contract_type' => $this->contract_type,
            'contract_status' => $this->contract_status,
            'contract_calender_type' => $this->contract_calender_type ,
            'contract_place' => $this->contract_place,
            'contract_date' => ($this->contract_calender_type == 2 ) ? CalendarController::dateToHijri($this->contract_date) : $this->contract_date,
            'contract_start_date' => ($this->contract_calender_type == 2 ) ? CalendarController::dateToHijri($this->contract_start_date) : $this->contract_start_date,
            'contract_end_date' => ($this->contract_calender_type == 2 ) ? CalendarController::dateToHijri($this->contract_end_date) : $this->contract_end_date,
            'contract_image' => ($this->contract_image == null ) ? null : url('/').'/upload/contracts/'.$this->contract_image,

            'owner_user_id' => $this->owner_user_id,
            'owner_name' => $this->owner_name,
            'owner_nationality' => $this->owner_nationality,
            'owner_id_type' => $this->owner_id_type,
            'owner_id_no' => $this->owner_id_no,
            'owner_id_image' => ($this->owner_id_image == null ) ? null : url('/').'/upload/users/id/'.$this->owner_id_image,
            'owner_mobile1' => $this->owner_mobile,
            'owner_email' => $this->owner_email,

            'renter_user_id' => $this->renter_user_id,
            'renter_name' => $this->renter_name,
            'renter_nationality' => $this->renter_nationality,
            'renter_id_type' => $this->renter_id_type,
            'renter_id_no' => $this->renter_id_no,
            'renter_id_image' => ($this->renter_id_image == null ) ? null : url('/').'/upload/users/id/'.$this->renter_id_image,
            'renter_mobile1' => $this->renter_mobile,
            'renter_email' => $this->renter_email,


            'agent_user_id' => $this->agent_user_id,
            'agent_name' => $this->agent_name,
            'agent_nationality' => $this->agent_nationality,
            'agent_id_type' => $this->agent_id_type,
            'agent_id_no' => $this->agent_id_no,
            'agent_id_image' => ($this->agent_id_image == null ) ? null : url('/').'/upload/users/id/'.$this->agent_id_image,
            'agent_mobile1' => $this->agent_mobile,
            'agent_email' => $this->agent_email,

            'agency_id' => $this->agency_id,
            'agency_name' => $this->agency_name,
            'agency_address' => $this->agency_address,
            'agency_commercial_register_no' => $this->agency_commercial_register_no,
            'agency_phone' => $this->agency_phone,
            'agency_fax' => $this->agency_fax,

            'm_property_id' => $this->m_property_id,
            'm_property_address' => $this->m_property_address,
            'm_property_type' => $this->m_property_type,
            'm_property_floors' => $this->m_property_floors,
            'm_property_units_no' => $this->m_property_units_no,
            'm_property_elevators' => $this->m_property_elevators,
            'm_property_parking' => $this->m_property_parking,
            
            'usage_type' => $this->usage_type,

            'sublease' => $this->sublease,

            'agency_amount' => $this->agency_amount,
            'guarantee_amount' => $this->guarantee_amount,
            'electricity_monthly_amount' => $this->electricity_monthly_amount,
            'water_monthly_amount' => $this->water_monthly_amount,
            'gas_monthly_amount' => $this->gas_monthly_amount,
            'parking_monthly_amount' => $this->parking_monthly_amount,
            'rented_parking_no' => $this->rented_parking_no,

            'rent_monthly_amount' => $this->rent_monthly_amount,
            'rent_period' => $this->rent_period,
            'rent_period_amount' => $this->rent_period_amount,
            'last_rent_amount' => $this->last_rent_amount,
            'rent_payments' => $this->rent_payments,
            'rent_total' => $this->rent_total,

            'rent_payment_no' => $this->rent_payment_no,

            'rent_payment_issued_date' => ($this->contract_calender_type == 2 ) ? CalendarController::dateToHijri($this->rent_payment_issued_date) : $this->rent_payment_issued_date,
            'rent_payment_due_date' => ($this->contract_calender_type == 2 ) ? CalendarController::dateToHijri($this->rent_payment_due_date) : $this->rent_payment_due_date,
            'rent_payment_amount' => $this->rent_payment_amount,

            'terms' => $this->terms,
    
            'contract_units' =>  $this->contract_units,
            'companions' =>  $this->companions,
            'payments' =>  $this->payments,
        ];


        

    }
}

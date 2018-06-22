<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{

    protected $fillable = [
        "contract_type","contract_condition","contract_status","contract_calender_type","contract_place","contract_date","contract_start_date","contract_end_date","contract_image",
        "owner_user_id","owner_name","owner_nationality","owner_id_type","owner_id_no","owner_id_image","owner_mobile1","owner_email",
        "renter_user_id","renter_name","renter_nationality","renter_id_type","renter_id_no","renter_id_image","renter_mobile1","renter_email",
        "is_agent",
        "agency_id","agency_name","agency_address","agency_commercial_register_no","agency_phone","agency_fax",
        "agent_user_id","agent_name","agent_nationality","agent_id_type","agent_id_no","agent_id_image","agent_mobile1","agent_email",
        "property_instrument_no","property_instrument_issuer","property_instrument_date","property_instrument_place",
        "m_property_id","m_property_address","m_property_type","m_property_floors","m_property_units_no","m_property_elevators","m_property_parking",
        "usage_type","sublease",
        "agency_amount","guarantee_amount","electricity_monthly_amount","water_monthly_amount","gas_monthly_amount","parking_monthly_amount","rented_parking_no",
        "rent_monthly_amount","rent_period","rent_period_amount","last_rent_amount","rent_payments","rent_total",
        "rent_payment_no","rent_payment_issued_date","rent_payment_due_date","rent_payment_amount",
        "terms",
        "created_by",'active','deleted'
    ];


    protected $casts = [
        'contract_type' => 'integer',
        'contract_condition' => 'integer',
        'contract_calender_type' => 'integer',
        'contract_place' => 'integer',
        'contract_status' => 'integer',
    ];

    public function contract_units()
    {
        return $this->hasMany('App\ContractUnit');
    }

    public function companions()
    {
        return $this->hasMany('App\Companion');
    }

    public function payments()
    {
        return $this->hasMany('App\Payment');
    }
}

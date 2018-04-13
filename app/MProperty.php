<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MProperty extends Model
{
    //
    protected $fillable = [
        'name','type','district','address','lat','long','floors','units','elevators','parking','year_of_construction','property_instrument_no','property_instrument_issuer','property_instrument_date','property_instrument_place','owner_user_id','owner_name','owner_nationality','owner_address','owner_id_type','owner_id_no','owner_id_issuer','owner_id_date','owner_id_exp_date','owner_email','owner_mobile','owner_bank','owner_bank_iban','owner_is_agent','agent_user_id','agent_name','agent_nationality','agent_address','agent_id_type','agent_id_no','agent_id_issuer','agent_id_date','agent_id_exp_date','agent_email','agent_mobile','agent_instrument_no','agent_instrument_issuer','agent_instrument_date','agent_instrument_exp_date','agent_bank','agent_bank_iban','commercial_register_name','commercial_register_no','commercial_register_issuer','commercial_register_date','commercial_register_exp_date','created_by','active','deleted'
    ];
}

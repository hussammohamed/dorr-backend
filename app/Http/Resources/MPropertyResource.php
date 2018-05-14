<?php

namespace App\Http\Resources;

use App;

use Auth;
use App\Type;
use App\Bank;
use App\Region;
use App\Nationality;
use App\IdType;
use App\User;
use App\Agency;

use App\Http\Resources\UnitResource;
use Illuminate\Http\Resources\Json\Resource;

class MPropertyResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        
        $owner = User::find($this->owner_user_id);
        if($this->agent_user_id != null ){
            $agent = User::find($this->agent_user_id);
            $agency = Agency::where("user_id",$this->agent_user_id)->first();
        }

        $owner_status = 0;
        $agent_status = 0;
        $agency_status = 0;
        $owner_data = ['owner' =>  null];
        $agent_data = ['agent' =>  null];
        $agency_data = ['agency' =>  null];

        $name = 'name_'.App::getLocale();

        $mproperty = [
            'id' => $this->id,
            'name' => $this->name,
            'type'=> $this->type,
            'address' => $this->address,
            'district' => $this->district,
            'region' => $this->district,
            'location' => [
                    'lat' => $this->lat,
                    'long' => $this->long,
            ],
            'floors' => $this->floors,
            'units_no' => $this->units_no,
            'elevators' => $this->elevators,
            'parking' => $this->parking,
            'year_of_construction' => $this->year_of_construction,
            'property_instrument_no' => $this->property_instrument_no,
            'property_instrument_issuer' => $this->property_instrument_issuer,
            'property_instrument_date' => $this->property_instrument_date,
            'property_instrument_place' => $this->property_instrument_place,
            'property_instrument_image' => ($this->property_instrument_image == null ) ? null : url('/').'/upload/mproperties/property_instrument/'.$this->property_instrument_image,


            'agency_instrument_no' => $this->agency_instrument_no,
            'agency_instrument_issuer' => $this->agency_instrument_issuer,
            'agency_instrument_date' => $this->agency_instrument_date,
            'agency_instrument_exp_date' => $this->agency_instrument_exp_date,
            'agency_instrument_image' => ($this->agency_instrument_image == null ) ? null : url('/').'/upload/mproperties/agency_instrument/'.$this->agency_instrument_image,
            'property_management_contract_image' => ($this->property_management_contract_image == null ) ? null : url('/').'/upload/mproperties/property_management_contract/'.$this->property_management_contract_image,

            'user_relation' => $this->user_relation,

            'created_by' =>  new UserResource(User::find($this->created_by)),
            
        ];
        
        if($this->owner_user_id != null ){
            $owner_data = [
                'owner' =>  new UserResource(User::find($this->owner_user_id)),
            ];

            if($this->owner_user_id != "" && $owner->name != "" && $owner->address != "" && $owner->email != "" && $owner->mobile1 != "" && $owner->nationality != "" && $owner->id_type != "" && $owner->id_no != "" && $owner->id_issuer != "" && $owner->id_issued_date != "" && $owner->id_exp_date != "" &&  $owner->bank != "" &&  $owner->bank_iban != ""){
                $owner_status = 1;
            }

        }
        

        if($this->agent_user_id != null ){
            $agent_data = [
                'agent' => new UserResource(User::find($this->agent_user_id)),
            ];

            if($this->agent_user_id != "" && $agent->name != "" && $agent->address != "" && $agent->email != "" && $agent->mobile1 != "" && $agent->nationality != "" && $agent->id_type != "" && $agent->id_no != "" && $agent->id_issuer != "" && $agent->id_issued_date != "" && $agent->id_exp_date != "" &&  $agent->bank != "" &&  $agent->bank_iban != ""){
                $agent_status = 1;
            }

            if($agency !== null){
                $agency_data = [
                    'agency' => new AgencyResource(Agency::find($agency->id)),
                ];
    
                if($agency->commercial_register_name != "" && $agency->commercial_register_no != "" && $agency->commercial_register_address != "" && $agency->commercial_register_issuer != "" && $agency->commercial_register_date != "" && $agency->commercial_register_exp_date != ""){
                    $agency_status = 1;
                }
            }
        }

        $data_status = [
            'data_status' =>[
                'owner' => $owner_status,
                'agent' => $agent_status,
                'agency' => $agency_status
            ] 
        ];

        $units = ['units' =>  UnitResource::collection($this->units)];

        return array_merge($mproperty,$owner_data,$agent_data,$agency_data,$data_status,$units);

    }
}


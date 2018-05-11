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
            'type'=> [
                'id' => $this->type,
                'name' => Type::find($this->type)->name_ar
            ],
            'address' => $this->address,
            'district' =>  $this->district,
            'region' => [
                'id' => Region::find($this->district)->region_id,
                'name' => Region::find(Region::find($this->district)->region_id)->name_ar
            ],
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
            'property_instrument_issuer' => ($this->property_instrument_issuer == null ) ? null : [
                'id' => $this->property_instrument_issuer,
                'name' => Region::find($this->property_instrument_issuer)->name_ar,
            ],
            'property_instrument_date' => $this->property_instrument_date,
            'property_instrument_place' => $this->property_instrument_place,


            'agency_instrument_no' => $this->agency_instrument_no,
            'agency_instrument_issuer' => ($this->agency_instrument_issuer == null ) ? null : [
                'id' => $this->agency_instrument_issuer,
                'name' => Region::find($this->agency_instrument_issuer)->$name,
            ],
            'agency_instrument_date' => $this->agency_instrument_date,
            'agency_instrument_exp_date' => $this->agency_instrument_exp_date,

            
            'created_by' =>  [
                'id'=> $this->created_by,
                'name'=> User::find($this->created_by)->name,
                'mobile1'=> User::find($this->created_by)->mobile1,
                'avatar'=> (User::find($this->created_by)->avatar == null ) ? null : url('/').'/upload/users/'.User::find($this->created_by)->avatar,
            ],
            
        ];
        
        if($this->owner_user_id != null ){
            $owner_data = [
                'owner' =>  [
                    'id' => $this->owner_user_id,
                    'name' => $owner->name,
                    'address' => $owner->address,
                    'email' => $owner->email,
                    'mobile1' => $owner->mobile1,
                    'avatar'=> (User::find($this->owner_user_id)->avatar == null ) ? null : url('/').'/upload/users/'.User::find($this->owner_user_id)->avatar,
                    'nationality' => ($owner->nationality == null ) ? null : [
                        'id' => $owner->nationality,
                        'name' => Nationality::find($owner->nationality)->$name,
                    ],
                    'id_type' => ($owner->id_type == null ) ? null : [
                        'id' => $owner->id_type,
                        'name' => IdType::find($owner->id_type)->$name,
                    ],
                    'id_no' => $owner->id_no,
                    'id_issuer' => ($owner->id_issuer == null ) ? null : [
                        'id' => $owner->id_issuer,
                        'name' => Region::find($owner->id_issuer)->$name,
                    ],
                    'id_issued_date' => $owner->id_issued_date,
                    'id_exp_date' => $owner->id_exp_date,
                    'bank' => ($owner->bank == null ) ? null : [
                        'id' => $owner->bank,
                        'name' => Bank::find($owner->bank)->$name,
                    ],
                    'bank_iban' => $owner->bank_iban,
                    'registered' => $owner->registered,
                ]
            ];

            if($this->owner_user_id != "" && $owner->name != "" && $owner->address != "" && $owner->email != "" && $owner->mobile1 != "" && $owner->nationality != "" && $owner->id_type != "" && $owner->id_no != "" && $owner->id_issuer != "" && $owner->id_issued_date != "" && $owner->id_exp_date != "" &&  $owner->bank != "" &&  $owner->bank_iban != ""){
                $owner_status = 1;
            }

        }
        

        if($this->agent_user_id != null ){
            $agent_data = [
                'agent' =>  [
                    'id' => $this->agent_user_id,
                    'name' => $agent->name,
                    'email' => $agent->email,
                    'mobile1' => $agent->mobile1,
                    'avatar'=> (User::find($this->agent_user_id)->avatar == null ) ? null : url('/').'/upload/users/'.User::find($this->agent_user_id)->avatar,
                    'address' => $agent->address,
                    'nationality' => ($agent->nationality == null ) ? null : [
                        'id' => $agent->nationality,
                        'name' => Nationality::find($agent->nationality)->$name,
                    ],
                    'id_type' => ($agent->id_type == null ) ? null : [
                        'id' => $agent->id_type,
                        'name' => IdType::find($agent->id_type)->$name,
                    ],
                    'id_no' => $agent->id_no,
                    'id_issuer' => ($agent->id_issuer == null ) ? null : [
                        'id' => $agent->id_issuer,
                        'name' => Region::find($agent->id_issuer)->$name,
                    ],
                    'id_issued_date' => $agent->id_issued_date,
                    'id_exp_date' => $agent->id_exp_date,
                    'bank' => ($agent->bank == null ) ? null : [
                        'id' => $agent->bank,
                        'name' => Bank::find($agent->bank)->$name,
                    ],
                    'bank_iban' => $agent->bank_iban,
                    'registered'=> $agent->registered
                ]
            ];

            if($this->agent_user_id != "" && $agent->name != "" && $agent->address != "" && $agent->email != "" && $agent->mobile1 != "" && $agent->nationality != "" && $agent->id_type != "" && $agent->id_no != "" && $agent->id_issuer != "" && $agent->id_issued_date != "" && $agent->id_exp_date != "" &&  $agent->bank != "" &&  $agent->bank_iban != "" && $this->agency_instrument_no != ""){
                $agent_status = 1;
            }

            if($agency !== null){
                $agency_data = [
                    'agency' => [
                        'id' => $agency->id,
                        'commercial_register_name' => $agency->commercial_register_name,
                        'commercial_register_no' => $agency->commercial_register_no,
                        'commercial_register_address' => $agency->commercial_register_address,
                        'commercial_register_issuer' => ($agency->commercial_register_issuer == null ) ? null : [
                            'id' => $agency->commercial_register_issuer,
                            'name' => Region::find($agency->commercial_register_issuer)->$name,
                        ],
                        'commercial_register_date' => $agency->commercial_register_date,
                        'commercial_register_exp_date' => $agency->commercial_register_exp_date,
                    ]
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
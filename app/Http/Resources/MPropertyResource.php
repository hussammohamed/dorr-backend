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

        $name = 'name_'.App::getLocale();

        return [
            'id' => $this->id,
            'name' => $this->name,
            'type'=> [
                'id' => $this->type,
                'name' => Type::find($this->type)->name_ar
            ],
            'address' => $this->address,
            'district' => [
                'id' => $this->district,
                'name' => Region::find($this->district)->name_ar
            ],
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
            'property_instrument_issuer' => [
                'id' => $this->property_instrument_issuer,
                'name' => ($this->property_instrument_issuer == null ) ? null : Region::find($this->property_instrument_issuer)->name_ar,
            ],
            'property_instrument_date' => $this->property_instrument_date,
            'property_instrument_place' => $this->property_instrument_place,
            'created_by' =>  [
                'id'=> $this->created_by,
                'name'=> User::find($this->created_by)->name,
                'mobile1'=> User::find($this->created_by)->mobile1,
                'avatar'=> (User::find($this->created_by)->avatar == null ) ? null : url('/').'/upload/users/'.User::find($this->created_by)->avatar,
            ],
            'owner' =>  [
                'id' => $this->owner_user_id,
                'name' => $owner->name,
                'address' => $owner->address,
                'email' => $owner->email,
                'mobile' => $owner->mobile1,
                'nationality' => [
                    'id' => $owner->nationality,
                    'name' => ($owner->nationality == null ) ? null : Nationality::find($owner->nationality)->$name,
                ],
                'owner_id_type' => [
                    'id' => $owner->id_type,
                    'name' => ($owner->id_type == null ) ? null : IdType::find($owner->id_type)->$name,
                ],
                'owner_id_no' => $owner->id_no,
                'owner_id_issuer' => [
                    'id' => $owner->id_issuer,
                    'name' => ($owner->id_issuer == null ) ? null : Region::find($owner->id_issuer)->$name,
                ],
                'owner_id_issued_date' => $owner->id_issued_date,
                'owner_id_exp_date' => $owner->id_exp_date,
                'owner_bank' => [
                    'id' => $owner->bank,
                    'name' => ($owner->bank == null ) ? null : Bank::find($owner->bank)->$name,
                ],
                'owner_bank_iban' => $owner->bank_iban,
            ],
            
            $this->mergeWhen(($this->agent_user_id != null), [
                
                'agent' =>  [
                    'id' => $this->agent_user_id,
                    'name' => $agent->name,
                    'email' => $agent->email,
                    'mobile' => $agent->mobile1,
                    'address' => $agent->address,
                    'nationality' => [
                        'id' => $agent->nationality,
                        'name' => ($agent->nationality == null ) ? null : Nationality::find($agent->nationality)->$name,
                    ],
                    'agent_id_type' => [
                        'id' => $agent->id_type,
                        'name' => ($agent->id_type == null ) ? null : IdType::find($agent->id_type)->$name,
                    ],
                    'agent_id_no' => $agent->id_no,
                    'agent_id_issuer' => [
                        'id' => $agent->id_issuer,
                        'name' => ($agent->id_issuer == null ) ? null : Region::find($agent->id_issuer)->$name,
                    ],
                    'agent_id_issued_date' => $agent->id_issued_date,
                    'agent_id_exp_date' => $agent->id_exp_date,
                    'agency_instrument_no' => $this->agency_instrument_no,
                    'agency_instrument_issuer' => [
                        'id' => $this->agency_instrument_issuer,
                        'name' => ($this->agency_instrument_issuer == null ) ? null : Region::find($this->agency_instrument_issuer)->$name,
                    ],
                    'agency_instrument_date' => $this->agency_instrument_date,
                    'agency_instrument_exp_date' => $this->agency_instrument_exp_date,
                    'agency_bank' => [
                        'id' => $agent->bank,
                        'name' => ($agent->bank == null ) ? null : Bank::find($agent->bank)->$name,
                    ],
                    'agency_bank_iban' => $agent->bank_iban,
                    'agency' => [
                        'id' => $agency->id,
                        'commercial_register_name' => $agency->commercial_register_name,
                        'commercial_register_no' => $agency->commercial_register_no,
                        'commercial_register_issuer' => [
                            'id' => $agency->commercial_register_issuer,
                            'name' => ($agency->commercial_register_issuer == null ) ? null : Region::find($agency->commercial_register_issuer)->$name,
                        ],
                        'commercial_register_date' => $agency->commercial_register_date,
                        'commercial_register_exp_date' => $agency->commercial_register_exp_date,
                    ],
                ],

            ]),

            'units' =>  UnitResource::collection($this->units)
            
        ];
    }
}


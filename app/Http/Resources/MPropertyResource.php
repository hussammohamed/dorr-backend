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
        
        return [
            'id' => $this->id,
            'property' => [
                'name' => $this->name,
                'type'=> [
                    'id' => $this->type,
                    'name' => Type::find($this->type)->name_ar
                ],
                'location' => [
                    'address' => $this->address,
                    'district' => [
                        'id' => $this->district,
                        'name' => Region::find($this->district)->name_ar
                    ],
                    'region' => [
                        'id' => Region::find($this->district)->region_id,
                        'name' => Region::find(Region::find($this->district)->region_id)->name_ar
                    ],
                    'map' => [
                        'lat' => $this->lat,
                        'long' => $this->long
                    ],
                ],
                'floors' => $this->floors,
                'units' => $this->units,
                'elevators' => $this->elevators,
                'parking' => $this->parking,
                'year_of_construction' => $this->year_of_construction,
                'property_instrument' =>  [
                    'no' => $this->property_instrument_no,
                    'issuer' => [
                        'id' => $this->property_instrument_issuer,
                        'name' => ($this->property_instrument_issuer == null ) ? null : Region::find($this->property_instrument_issuer)->name_ar,
                    ],
                    'date' => $this->property_instrument_date,
                    'place' => $this->property_instrument_place,
                ],
            ],
            'created_by' =>  [
                'id'=> $this->created_by,
                'name'=> User::find($this->created_by)->name,
                'mobile1'=> User::find($this->created_by)->mobile1,
                'avatar'=> (User::find($this->created_by)->avatar == null ) ? null : url('/').'/upload/users/'.User::find($this->created_by)->avatar,
            ],
            'owner' =>  [
                'user_id' => $this->owner_user_id,
                'name' => $this->owner_name,
                'address' => $this->owner_address,
                'email' => $this->owner_email,
                'mobile' => $this->owner_mobile,
                'nationality' => [
                    'id' => $this->owner_nationality,
                    'name' => ($this->owner_nationality == null ) ? null : Nationality::find($this->owner_nationality)->name,
                ],
                'owner_id' => [
                    'type' => [
                        'id' => $this->owner_id_type,
                        'name' => ($this->owner_id_type == null ) ? null : IdType::find($this->owner_id_type)->name,
                    ],
                    'no' => $this->owner_id_no,
                    'issuer' => [
                        'id' => $this->owner_id_issuer,
                        'name' => ($this->owner_id_issuer == null ) ? null : Region::find($this->owner_id_issuer)->name_ar,
                    ],
                    'date' => $this->owner_id_date,
                    'exp_date' => $this->owner_id_exp_date,
                ],
                'bank' => [
                    'id' => $this->owner_bank,
                    'name' => ($this->owner_bank == null ) ? null : Bank::find($this->owner_bank)->name,
                    'iban' => $this->owner_bank_iban,
                ],
                'owner_is_agent' => $this->owner_is_agent,
            ],

            'agent' =>  [
                'user_id' => $this->agent_user_id,
                'name' => $this->agent_name,
                'agent_email' => $this->agent_email,
                'agent_mobile' => $this->agent_mobile,
                'address' => $this->agent_address,
                'nationality' => [
                    'id' => $this->agent_nationality,
                    'name' => ($this->agent_nationality == null ) ? null : Nationality::find($this->agent_nationality)->name,
                ],
                'agent_id' => [
                    'agent_id_type' => [
                        'id' => $this->agent_id_type,
                        'name' => ($this->agent_id_type == null ) ? null : IdType::find($this->agent_id_type)->name,
                    ],
                    'no' => $this->agent_id_no,
                    'issuer' => [
                        'id' => $this->agent_id_issuer,
                        'name' => ($this->agent_id_issuer == null ) ? null : Region::find($this->agent_id_issuer)->name_ar,
                    ],
                    'date' => $this->agent_id_date,
                    'exp_date' => $this->agent_id_exp_date,
                ],
                'agency_instrument' => [
                    'no' => $this->agent_instrument_no,
                    'issuer' => [
                        'id' => $this->agent_instrument_issuer,
                        'name' => ($this->agent_instrument_issuer == null ) ? null : Region::find($this->agent_instrument_issuer)->name_ar,
                    ],
                    'date' => $this->agent_instrument_date,
                    'exp_date' => $this->agent_instrument_exp_date,
                ],
                'bank' => [
                    'id' => $this->agent_bank,
                    'name' => ($this->agent_bank == null ) ? null : Bank::find($this->agent_bank)->name,
                    'iban' => $this->agent_bank_iban,
                ],
                'commercial_register' => [
                    'name' => $this->commercial_register_name,
                    'no' => $this->commercial_register_no,
                    'issuer' => [
                        'id' => $this->commercial_register_issuer,
                        'name' => ($this->commercial_register_issuer == null ) ? null : Region::find($this->commercial_register_issuer)->name_ar,
                    ],
                    'date' => $this->commercial_register_date,
                    'exp_date' => $this->commercial_register_exp_date,
                ],
            ],
            
        ];
/*
        return [
            'id' => $this->id,
            'name' => $this->name,
            'type' => $this->type,
            'address' => $this->address,
            'district' => $this->district,
            'lat' => $this->lat,
            'long' => $this->long,
            'floors' => $this->floors,
            'units' => $this->units,
            'elevators' => $this->elevators,
            'parking' => $this->parking,
            'year_of_construction' => $this->year_of_construction,
            'property_instrument_no' => $this->property_instrument_no,
            'property_instrument_issuer' => $this->property_instrument_issuer,
            'property_instrument_date' => $this->property_instrument_date,
            'property_instrument_place' => $this->property_instrument_place,
            'created_by' => $this->created_by,
            'owner_user_id' => $this->owner_user_id,
            'owner_name' => $this->owner_name,
            'owner_nationality' => $this->owner_nationality,
            'owner_address' => $this->owner_address,
            'owner_id_type' => $this->owner_id_type,
            'owner_id_no' => $this->owner_id_no,
            'owner_id_issuer' => $this->owner_id_issuer,
            'owner_id_date' => $this->owner_id_date,
            'owner_id_exp_date' => $this->owner_id_exp_date,
            'owner_email' => $this->owner_email,
            'owner_mobile' => $this->owner_mobile,
            'owner_bank' => $this->owner_bank,
            'owner_bank_iban' => $this->owner_bank_iban,
            'owner_is_agent' => $this->owner_is_agent,
            'agent_user_id' => $this->agent_user_id,
            'agent_name' => $this->agent_name,
            'agent_nationality' => $this->agent_nationality,
            'agent_address' => $this->agent_address,
            'agent_id_type' => $this->agent_id_type,
            'agent_id_no' => $this->agent_id_no,
            'agent_id_issuer' => $this->agent_id_issuer,
            'agent_id_date' => $this->agent_id_date,
            'agent_id_exp_date' => $this->agent_id_exp_date,
            'agent_email' => $this->agent_email,
            'agent_mobile' => $this->agent_mobile,
            'agent_instrument_no' => $this->agent_instrument_no,
            'agent_instrument_issuer' => $this->agent_instrument_issuer,
            'agent_instrument_date' => $this->agent_instrument_date,
            'agent_instrument_exp_date' => $this->agent_instrument_exp_date,
            'agent_bank' => $this->agent_bank,
            'agent_bank_iban' => $this->agent_bank_iban,
            'commercial_register_name' => $this->commercial_register_name,
            'commercial_register_no' => $this->commercial_register_no,
            'commercial_register_issuer' => $this->commercial_register_issuer,
            'commercial_register_date' => $this->commercial_register_date,
            'commercial_register_exp_date' => $this->commercial_register_exp_date,
        ];*/
    }
}



/*
        return [
            'id' => $this->id,
            
            'name' => $this->name,
            'type' => $this->type,
            'address' => $this->address,
            'district' => [
                'id' => $this->region,
                'name' => Region::find($this->region)->name_ar
            ],
            'location' => [
                'lat' => $this->lat,
                'long' => $this->long
            ],
            'floors' => $this->floors,
            'units' => $this->units,
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
                'owner_user_id' => $this->owner_user_id,
                'owner_name' => $this->owner_name,
                'owner_nationality' => [
                    'id' => $this->owner_nationality,
                    'name' => ($this->owner_nationality == null ) ? null : Nationality::find($this->owner_nationality)->name,
                ],
                'owner_address' => $this->owner_address,
                'owner_id_type' => [
                    'id' => $this->owner_id_type,
                    'name' => ($this->owner_id_type == null ) ? null : IdType::find($this->owner_id_type)->name,
                ],
                'owner_id_no' => $this->owner_id_no,
                'owner_id_issuer' => [
                    'id' => $this->owner_id_issuer,
                    'name' => ($this->owner_id_issuer == null ) ? null : Region::find($this->owner_id_issuer)->name_ar,
                ],
                'owner_id_date' => $this->owner_id_date,
                'owner_id_exp_date' => $this->owner_id_exp_date,
                'owner_email' => $this->owner_email,
                'owner_mobile' => $this->owner_mobile,
                'owner_bank' => [
                    'id' => $this->owner_bank,
                    'name' => ($this->owner_bank == null ) ? null : Bank::find($this->owner_bank)->name,
                ],
                'owner_bank_iban' => $this->owner_bank_iban,
                'owner_is_agent' => $this->owner_is_agent,
            ],

            'agent' =>  [
                'agent_user_id' => $this->agent_user_id,
                'agent_name' => $this->agent_name,
                'agent_nationality' => [
                    'id' => $this->agent_nationality,
                    'name' => ($this->agent_nationality == null ) ? null : Nationality::find($this->agent_nationality)->name,
                ],
                'agent_address' => $this->agent_address,
                'agent_id_type' => [
                    'id' => $this->agent_id_type,
                    'name' => ($this->agent_id_type == null ) ? null : IdType::find($this->agent_id_type)->name,
                ],
                'agent_id_no' => $this->agent_id_no,
                'agent_id_issuer' => [
                    'id' => $this->agent_id_issuer,
                    'name' => ($this->agent_id_issuer == null ) ? null : Region::find($this->agent_id_issuer)->name_ar,
                ],
                'agent_id_date' => $this->agent_id_date,
                'agent_id_exp_date' => $this->agent_id_exp_date,
                'agent_email' => $this->agent_email,
                'agent_mobile' => $this->agent_mobile,
                'agent_instrument_no' => $this->agent_instrument_no,
                'agent_instrument_issuer' => [
                    'id' => $this->agent_instrument_issuer,
                    'name' => ($this->agent_instrument_issuer == null ) ? null : Region::find($this->agent_instrument_issuer)->name_ar,
                ],
                'agent_instrument_date' => $this->agent_instrument_date,
                'agent_instrument_exp_date' => $this->agent_instrument_exp_date,
                'agent_bank' => [
                    'id' => $this->agent_bank,
                    'name' => ($this->agent_bank == null ) ? null : Bank::find($this->agent_bank)->name,
                ],
                'agent_bank_iban' => $this->agent_bank_iban,
                'commercial_register_name' => $this->commercial_register_name,
                'commercial_register_no' => $this->commercial_register_no,
                'commercial_register_issuer' => [
                    'id' => $this->commercial_register_issuer,
                    'name' => ($this->commercial_register_issuer == null ) ? null : Region::find($this->commercial_register_issuer)->name_ar,
                ],
                'commercial_register_date' => $this->commercial_register_date,
                'commercial_register_exp_date' => $this->commercial_register_exp_date,
            ],
            
        ];
*/



/*
        return [
            'id' => $this->id,
            'name' => $this->name,
            'type' => $this->type,
            'address' => $this->address,
            'district' => $this->district,
            'lat' => $this->lat,
            'long' => $this->long
            'floors' => $this->floors,
            'units' => $this->units,
            'elevators' => $this->elevators,
            'parking' => $this->parking,
            'year_of_construction' => $this->year_of_construction,
            'property_instrument_no' => $this->property_instrument_no,
            'property_instrument_issuer' => property_instrument_issuer,
            'property_instrument_date' => $this->property_instrument_date,
            'property_instrument_place' => $this->property_instrument_place,
            'created_by' => $this->created_by,
            'owner_user_id' => $this->owner_user_id,
            'owner_name' => $this->owner_name,
            'owner_nationality' => $this->owner_nationality,
            'owner_address' => $this->owner_address,
            'owner_id_type' => $this->owner_id_type,
            'owner_id_no' => $this->owner_id_no,
            'owner_id_issuer' => $this->owner_id_issuer,
            'owner_id_date' => $this->owner_id_date,
            'owner_id_exp_date' => $this->owner_id_exp_date,
            'owner_email' => $this->owner_email,
            'owner_mobile' => $this->owner_mobile,
            'owner_bank' => $this->owner_bank,
            'owner_bank_iban' => $this->owner_bank_iban,
            'owner_is_agent' => $this->owner_is_agent,
            'agent_user_id' => $this->agent_user_id,
            'agent_name' => $this->agent_name,
            'agent_nationality' => $this->agent_nationality,
            'agent_address' => $this->agent_address,
            'agent_id_type' => $this->agent_id_type,
            'agent_id_no' => $this->agent_id_no,
            'agent_id_issuer' => $this->agent_id_issuer,
            'agent_id_date' => $this->agent_id_date,
            'agent_id_exp_date' => $this->agent_id_exp_date,
            'agent_email' => $this->agent_email,
            'agent_mobile' => $this->agent_mobile,
            'agent_instrument_no' => $this->agent_instrument_no,
            'agent_instrument_issuer' => $this->agent_instrument_issuer,
            'agent_instrument_date' => $this->agent_instrument_date,
            'agent_instrument_exp_date' => $this->agent_instrument_exp_date,
            'agent_bank' => $this->agent_bank,
            'agent_bank_iban' => $this->agent_bank_iban,
            'commercial_register_name' => $this->commercial_register_name,
            'commercial_register_no' => $this->commercial_register_no,
            'commercial_register_issuer' => $this->commercial_register_issuer,
            'commercial_register_date' => $this->commercial_register_date,
            'commercial_register_exp_date' => $this->commercial_register_exp_date,
        ];
*/


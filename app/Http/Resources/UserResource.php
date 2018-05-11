<?php

namespace App\Http\Resources;

use App;
use App\IdType;
use App\Bank;
use App\Nationality;
use App\Region;

use Illuminate\Http\Resources\Json\Resource;

class UserResource extends Resource
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
            'name' => $this->name,
            'first_name' => $this->first_name,
            'family_name' => $this->family_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'mobile1' => $this->mobile1,
            'mobile2' => $this->mobile2,
            'api_token' => $this->api_token,
            'avatar' => ($this->id_image == null ) ? null : url('/').'/upload/users/'.$this->avatar,
            'nationality' => 
                ($this->nationality == null ) ? null :
                [
                    "id" => $this->nationality,
                    "name" => Nationality::find($this->nationality)->$name
                ],
            'address' => $this->address,
            'id_type' =>
                ($this->id_type == null ) ? null :
                [
                    "id" => $this->id_type,
                    "name" => IdType::find($this->id_type)->$name
                ],
            'id_no' => $this->id_no,

            'id_issuer' => ($this->id_issuer == null ) ? null : [
                'id' => $this->id_issuer,
                'name' => Region::find($this->id_issuer)->$name,
            ],

            'id_issued_date' => $this->id_issued_date,
            'id_exp_date' => $this->id_exp_date,
            'id_image' => ($this->id_image == null ) ? null : url('/').'/upload/users/'.$this->id_image,
            'bank' => 
                ($this->bank == null ) ? null : 
                [
                    "id" => $this->bank,
                    "name" => Bank::find($this->bank)->$name,
                ],
            'bank_iban' => $this->bank_iban
        ];
    }
}

<?php

namespace App\Http\Resources;

use App;
use App\IdType;
use App\Bank;
use App\Nationality;

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
            'avatar' => url('/').'/upload/users/'.$this->avatar,
            'nationality' => [
                "id" => $this->nationality,
                "name" => ($this->nationality == null ) ? null : Nationality::find($this->nationality)->$name
            ],
            'address' => $this->address,
            'id_type' => [
                "id" => $this->id_type,
                "name" => ($this->id_type == null ) ? null : IdType::find($this->id_type)->$name
            ],
            'id_no' => $this->id_no,
            'id_issuer' => $this->id_issuer,
            'id_issued_date' => $this->id_issued_date,
            'id_exp_date' => $this->id_exp_date,
            'bank' => [
                "id" => $this->bank,
                "name" => ($this->bank == null ) ? null : Bank::find($this->bank)->$name,
                'bank_iban' => $this->bank_iban
            ]
        ];
    }
}

<?php

namespace App\Http\Resources;

use App\Agency;
use App\User;

use Illuminate\Http\Resources\Json\Resource;

class AgencyResource extends Resource
{
    /**
     * 
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
		    'user_id' => $this->user_id,
            'commercial_register_name' => $this->commercial_register_name,
            'commercial_register_no' => $this->commercial_register_no,
		    'commercial_register_issuer' => $this->commercial_register_issuer,
		    'commercial_register_date' => $this->commercial_register_date,
            'commercial_register_exp_date' => $this->commercial_register_exp_date,
            'commercial_register_image' => $this->commercial_register_image
        ];
    }
}

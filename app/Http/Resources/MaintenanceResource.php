<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class MaintenanceResource extends Resource
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
            'm_property_id' => $this->m_property_id,
            'unit_id' => $this->unit_id,
            'service_type' => $this->service_type,
            'service'=> $this->service,
            'description' => $this->description,
            'owner_response' => $this->owner_response,
            'min_fix_amount' => $this->min_fix_amount,
            'laborer_pay' => $this->laborer_pay,
            'matrials_price' => $this->matrials_price,
            'invoice_image' => ($this->invoice_image == null ) ? null : url('/').'/upload/maintenances/'.$this->invoice_image,
            'status' => $this->status
        ];
    }
}

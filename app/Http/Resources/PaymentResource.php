<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class PaymentResource extends Resource
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
            'contract_id' => $this->contract_id,
            'm_property_id' => $this->m_property_id,
            'owner_user_id' => $this->owner_user_id,
            'renter_user_id'=> $this->renter_user_id,
            'serial' => $this->serial,
            'issued_date' => $this->issued_date,
            'due_date' => $this->due_date,
            'amount' => $this->amount,
            'status' => $this->status,
            'notification' => $this->notification,
        ];
    }
}

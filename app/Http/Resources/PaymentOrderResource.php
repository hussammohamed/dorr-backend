<?php

namespace App\Http\Resources;

use App\Contract;

use Illuminate\Http\Resources\Json\Resource;

use App\Http\Resources\PaymentCollectResource;
class PaymentOrderResource extends Resource
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
            'payment_id' => $this->payment_id,
            'contract_id' => $this->contract_id,
            'contract_calender_type' => Contract::find($this->contract_id)->contract_calender_type,
            'm_property_id' => $this->m_property_id,
            'units' => $this->units,
            'due_date' => $this->due_date,
            'amount' => $this->amount,
            'status' => $this->status,
            'notification' => $this->notification,
            "payment_collects" => $this->payment_collects,
        ];
    }
}

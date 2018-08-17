<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class TransferRequestResource extends Resource
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
            'name' => $this->name,
            'amount' => $this->amount,
            'method' => $this->method,
            'image' => ($this->image == null ) ? null : url('/').'/upload/transfer_requests/'.$this->image,
            'notes' => $this->notes,
            'status' => $this->status,
            'created_at' => $this->created_at
        ];
    }
}

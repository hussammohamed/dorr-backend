<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class TransactionResource extends Resource
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
            'type' => $this->type,
            'name' => $this->name,
            'amount' => $this->amount,
            'method' => $this->method,
            'image' => ($this->image == null ) ? null : url('/').'/upload/transactions/'.$this->image,
            'notes' => $this->notes,
            'created_at' => $this->created_at
        ];
    }
}

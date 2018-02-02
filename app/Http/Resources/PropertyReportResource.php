<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;
use App\User;

class PropertyReportResource extends Resource
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
            'report_id' => $this->id,
            'comment' => $this->comment,
            'User' => [
                'id'=> $this->user_id,
                'name'=> User::find($this->user_id)->name,
                'phone'=> User::find($this->user_id)->mobile1,
            ],
        ];
    }
}

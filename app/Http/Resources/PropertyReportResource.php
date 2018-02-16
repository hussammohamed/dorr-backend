<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;
use App;
use App\User;
use App\ReportingReason;

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
        $name = 'name_'.App::getLocale();
        return [
            'report_id' => $this->id,
            "reason" => [
                "id" => $this->reason,
                "name" => ReportingReason::find($this->reason)->$name,
            ],
            'comment' => $this->comment,
            'User' => [
                'id'=> $this->user_id,
                'name'=> User::find($this->user_id)->name,
                'phone'=> User::find($this->user_id)->mobile1,
            ],
        ];
    }
}

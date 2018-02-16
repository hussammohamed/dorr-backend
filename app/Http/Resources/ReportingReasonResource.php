<?php

namespace App\Http\Resources;

use App;
use App\ReportingReason;

use Illuminate\Http\Resources\Json\Resource;

class ReportingReasonResource extends Resource
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
            'name' => $this->$name,
            'value' => $this->id
        ];
    }
}

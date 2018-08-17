<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransferRequest extends Model
{
    public function mproperty()
    {
        return $this->belongsTo('App\MProperty');
    }

    protected $fillable = [
        'm_property_id','name','amount','method','notes','image','status'
    ];

    protected $casts = [
        'm_property_id' => 'integer',
        'name' => 'string',
        'amount' => 'integer',
        'method' => 'integer',
        'notes' => 'string',
        'image' => 'string',
        'status' => 'integer',
    ];
}

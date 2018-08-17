<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    public function mproperty()
    {
        return $this->belongsTo('App\MProperty');
    }

    protected $fillable = [
        'm_property_id','type','name','amount','method','notes','image'
    ];

    protected $casts = [
        'm_property_id' => 'integer',
        'type' => 'integer',
        'name' => 'string',
        'amount' => 'integer',
        'method' => 'integer',
        'notes' => 'string',
        'image' => 'string',
    ];
}

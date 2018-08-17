<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    //
    public function mproperty()
    {
        return $this->belongsTo('App\MProperty');
    }

    public function contract()
    {
        return $this->belongsTo('App\Contract');
    }

    protected $fillable = [
        'contract_id','m_property_id','owner_user_id','renter_user_id','serial','issued_date','due_date','amount','status','notification'
    ];

    protected $casts = [
        'contract_id' => 'integer',
        'm_property_id' => 'integer',
        'owner_user_id' => 'integer',
        'renter_user_id' => 'integer',
        'serial' => 'integer',
        'amount' => 'integer',
        'status' => 'integer',
        'notification' => 'integer'
    ];
}
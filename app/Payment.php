<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    //

    public function contract()
    {
        return $this->belongsTo('App\Contract');
    }

    protected $fillable = [
        'contract_id','owner_user_id','renter_user_id','serial','issued_date','due_date','amount','notification'
    ];

    protected $casts = [
        'contract_id' => 'integer',
        'owner_user_id' => 'integer',
        'renter_user_id' => 'integer',
        'serial' => 'integer',
        'amount' => 'integer',
        'notification' => 'integer'
    ];
}
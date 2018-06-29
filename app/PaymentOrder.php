<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentOrder extends Model
{
    //
    protected $fillable = [
        'payment_id','contract_id','m_property_id','units','due_date','amount','notification','status'
    ];

    protected $casts = [
        'payment_id' => 'integer', 'contract_id' => 'integer', 'm_property_id' => 'integer',
        'amount' => 'integer', 'notification' => 'integer', 'status' => 'integer'
    ];

    public function payment_collects()
    {
        return $this->hasMany('App\PaymentCollect');
    }

    public function mproperty()
    {
        return $this->belongsTo('App\MProperty');
    }
}

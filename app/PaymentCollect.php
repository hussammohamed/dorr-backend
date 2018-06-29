<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentCollect extends Model
{
    //
    protected $fillable = [
        'payment_order_id','due_date','amount','notification','status'
    ];

    protected $casts = [
        'payment_order_id' => 'integer', 'amount' => 'integer', 
        'notification' => 'integer', 'status' => 'integer'
    ];

    public function payment_order()
    {
        return $this->belongsTo('App\PaymentOrder');
    }
}

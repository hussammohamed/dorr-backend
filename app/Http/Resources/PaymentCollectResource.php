<?php

namespace App\Http\Resources;

use DB;
use App\PaymentOrder;
use Illuminate\Http\Resources\Json\Resource;

class PaymentCollectResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        $paid = DB::table('payment_collects')->where('payment_order_id', $this->payment_order_id)->sum('amount');
        $amount = PaymentOrder::find($this->payment_order_id)->amount;
        $remain = $amount - $paid;

        return [
            'id' => $this->id,
            'payment_order_id' => $this->payment_order_id,
            'due_date' => $this->due_date,
            'amount' => $this->amount,
            'remain' => $remain,
            'status' => $this->status,
            'notification' => $this->notification
        ];
    }
}

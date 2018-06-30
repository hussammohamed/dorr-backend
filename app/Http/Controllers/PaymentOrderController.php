<?php

namespace App\Http\Controllers;

use App\PaymentOrder;
use Auth;
use App\Payment;
use App\Contract;


use App\Http\Resources\PaymentOrderResource;

use Illuminate\Http\Request;

class PaymentOrderController extends Controller
{
    
    private $modelname = "payment_order";
    private $modelnames = "payment_orders";

    public function __construct()
    {
        $this->middleware('auth:api');//->except('index','show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return [ $this->modelnames => PaymentOrderResource::collection(PaymentOrder::get())];
    }

    public function indexByMProperty($id)
    {
        return [ $this->modelnames => PaymentOrderResource::collection(PaymentOrder::Where('m_property_id',$id)->get())];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        if (Auth::check()) {
            $data = (array) json_decode($request->request->get('data'));

            $payment = Payment::find($data["payment_id"]);
            
            $contract = Contract::find($payment->contract_id);

            $contract_units = $contract->contract_units;
            
            $units="";
            
            foreach ($contract_units as $contract_unit) {

                $units = $units.$contract_unit->unit_id.",";
            }
            
            $data["contract_id"] = $payment->contract_id;  
            $data["m_property_id"] = $contract->m_property_id;  
            $data["units"] = $units;
            $data["due_date"] = $payment->due_date;  
            $data["amount"] = $payment->amount;  
            $data["notification"] = $payment->notification;  
            
            $payment_order = PaymentOrder::create($data);

            return [ $this->modelname => new PaymentOrderResource($payment_order)];
        }else{
            return response()->json(["error"=>"There is no logined user"], Response::HTTP_UNAUTHORIZED);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PaymentOrder  $paymentOrder
     * @return \Illuminate\Http\Response
     */
    public function show(PaymentOrder $paymentOrder)
    {
        //
        return [ $this->modelname => new PaymentOrderResource($paymentOrder)];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PaymentOrder  $paymentOrder
     * @return \Illuminate\Http\Response
     */
    public function edit(PaymentOrder $paymentOrder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PaymentOrder  $paymentOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        if (Auth::check()) {
            $data = (array) json_decode($request->request->get('data'));

            $payment_order = PaymentOrder::find($id); 
            $payment_order->update($data);          

            return [ $this->modelname => new PaymentOrderResource($payment_order)];
        }else{
            return response()->json(["error"=>"There is no logined user"], Response::HTTP_UNAUTHORIZED);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PaymentOrder  $paymentOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaymentOrder $paymentOrder)
    {
        //
    }
}

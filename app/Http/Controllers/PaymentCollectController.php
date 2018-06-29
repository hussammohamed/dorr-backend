<?php

namespace App\Http\Controllers;

use App\PaymentCollect;

use App\PaymentOrder;
use Auth;
use App\Payment;
use App\Contract;

use App\Http\Resources\PaymentCollectResource;

use Illuminate\Http\Request;

class PaymentCollectController extends Controller
{
    
    private $modelname = "payment_collect";
    private $modelnames = "payment_collects";

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
        return [ $this->modelnames => PaymentCollectResource::collection(PaymentCollect::get())];
    }

    public function indexByPaymentOrder($id)
    {
        return [ $this->modelnames => PaymentCollectResource::collection(PaymentCollect::Where('payment_order_id',$id)->get())];
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

            $payment_order = PaymentCollect::create($data);

            return [ $this->modelname => new PaymentCollectResource($payment_order)];
        }else{
            return response()->json(["error"=>"There is no logined user"], Response::HTTP_UNAUTHORIZED);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PaymentCollect  $paymentCollect
     * @return \Illuminate\Http\Response
     */
    public function show(PaymentCollect $paymentCollect)
    {
        //
        return [ $this->modelname => new PaymentCollectResource($paymentCollect)];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PaymentCollect  $paymentCollect
     * @return \Illuminate\Http\Response
     */
    public function edit(PaymentCollect $paymentCollect)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PaymentCollect  $paymentCollect
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        if (Auth::check()) {
            $data = (array) json_decode($request->request->get('data'));

            $payment_collect = PaymentCollect::find($id); 
            $payment_collect->update($data);          

            return [ $this->modelname => new PaymentCollectResource($payment_collect)];
        }else{
            return response()->json(["error"=>"There is no logined user"], Response::HTTP_UNAUTHORIZED);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PaymentCollect  $paymentCollect
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaymentCollect $paymentCollect)
    {
        //
    }
}

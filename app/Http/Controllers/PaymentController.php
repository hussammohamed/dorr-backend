<?php

namespace App\Http\Controllers;

use Auth;
use App;
use App\Payment;

use App\Http\Requests\PaymentRequest;
use App\Http\Resources\PaymentResource;

use Illuminate\Http\Response;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    
    private $modelname = "payment";
    private $modelnames = "payments";

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
        return [ $this->modelnames => PaymentResource::collection(Payment::get())];
    }

    public function indexByMProperty($id)
    {
        return [ $this->modelnames => PaymentResource::collection(Payment::Where('m_property_id',$id)->get())];
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

            $payment = Payment::create($data);
            

            return [ $this->modelname => new PaymentResource($payment)];
        }else{
            return response()->json(["error"=>"There is no logined user"], Response::HTTP_UNAUTHORIZED);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        //
        return [ $this->modelname => new PaymentResource($payment)];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        if (Auth::check()) {
            $data = (array) json_decode($request->request->get('data'));

            $payment = Payment::find($id); 
            $payment->update($data);          

            return [ $this->modelname => new PaymentResource($payment)];
        }else{
            return response()->json(["error"=>"There is no logined user"], Response::HTTP_UNAUTHORIZED);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        //
        $payment->delete();
        return response(null,Response::HTTP_NO_CONTENT);
    }
}

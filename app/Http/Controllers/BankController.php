<?php

namespace App\Http\Controllers;

use Auth;
use App;
use App\Bank;

use App\Http\Requests\BankRequest;
use App\Http\Resources\BankResource;

use Illuminate\Http\Response;
use Illuminate\Http\Request;

class BankController extends Controller
{

    /*
    public function __construct()
    {
        $this->middleware('auth:api')->except('index','show');
    }
    */



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return BankResource::collection(Bank::paginate(5));
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
    public function store(BankRequest $request)
    {
        //
        if (Auth::check()) {
            $bank = new Bank;
            $bank->name =$request->name;
            $bank->order =1;
            
            $bank->save();
            
            return response(['data' => new BankResource($bank)],Response::HTTP_CREATED);

        }else{
            return response()->json(["error"=>"There is no logined user"], Response::HTTP_UNAUTHORIZED);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function show(Bank $bank)
    {
        return new BankResource($bank);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function edit(Bank $bank)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bank $bank)
    {
        //
        if (Auth::check()) {
                $bank->update($request->all());
                return response(['data' => new BankResource($bank)],Response::HTTP_CREATED);
        }else{
            return response()->json(["error"=>"There is no logined user"], Response::HTTP_UNAUTHORIZED);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bank $bank)
    {
        $bank->delete();
        return response(null,Response::HTTP_NO_CONTENT);
    }
}

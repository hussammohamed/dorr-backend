<?php

namespace App\Http\Controllers;

use Auth;
use App;
use App\Transaction;

use App\Http\Requests\TransactionRequest;
use App\Http\Resources\TransactionResource;

use Illuminate\Http\Response;
use Illuminate\Http\Request;

class TransactionController extends Controller
{

    private $modelname = "transaction";
    private $modelnames = "transactions";

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
        return [ $this->modelnames => TransactionResource::collection(Transaction::get())];
    }

    public function indexByMProperty($id)
    {
        return [ $this->modelnames => TransactionResource::collection(Transaction::Where('m_property_id',$id)->get())];
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

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $image_fileName = str_random(20).".".$extension;
                $folderpath  = 'upload/transactions/';
                $file->move($folderpath , $image_fileName);
                $data["image"] = $image_fileName;
            }

            $transaction = Transaction::create($data);
            
            return [ $this->modelname => new TransactionResource($transaction)];
        }else{
            return response()->json(["error"=>"There is no logined user"], Response::HTTP_UNAUTHORIZED);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
        return [ $this->modelname => new TransactionResource($transaction)];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        if (Auth::check()) {
            $data = (array) json_decode($request->request->get('data'));

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $image_fileName = str_random(20).".".$extension;
                $folderpath  = 'upload/transactions/';
                $file->move($folderpath , $image_fileName);
                $data["image"] = $image_fileName;
            }
            
            $transaction = Transaction::find($id); 

            $transaction->update($data);          

            return [ $this->modelname => new TransactionResource($transaction)];
        }else{
            return response()->json(["error"=>"There is no logined user"], Response::HTTP_UNAUTHORIZED);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
        $transaction->delete();
        return response(null,Response::HTTP_NO_CONTENT);
    }
}

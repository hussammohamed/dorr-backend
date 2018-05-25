<?php

namespace App\Http\Controllers;

use Auth;
use App;
use App\Contract;

//use App\Http\Requests\BankRequest;
use App\Http\Resources\ContractResource;

use Illuminate\Http\Response;
use Illuminate\Http\Request;

class ContractController extends Controller
{

    private $modelname = "contract";
    private $modelnames = "contracts";

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
        return [ $this->modelnames => ContractResource::collection(Contract::orWhere('owner_user_id',Auth::user()->id)->orWhere('agent_user_id',Auth::user()->id)->orWhere('renter_user_id',Auth::user()->id)->where('active',1)->where('deleted',0)->get())];
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
        
        if (Auth::check()) {

            $data = (array) json_decode($request->request->get('data'));

            $data["created_by"] = Auth::user()->id;


            $contract = Contract::create($data);
            
            return [ $this->modelname => new ContractResource($contract)];
        }else{
            return response()->json(["error"=>"There is no logined user"], Response::HTTP_UNAUTHORIZED);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function show(Contract $contract)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function edit(Contract $contract)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contract $contract)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contract $contract)
    {
        //
    }
}

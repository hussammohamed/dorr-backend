<?php

namespace App\Http\Controllers;

use Auth;
use App;
use App\Agency;

use App\Http\Requests\AgencyRequest;
use App\Http\Resources\AgencyResource;

use Illuminate\Http\Response;
use Illuminate\Http\Request;

class AgencyController extends Controller
{

    private $modelname = "agency";
    private $modelnames = "agencies";


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
        return [ $this->modelnames => AgencyResource::collection(Agency::get())];
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
    public function store(AgencyRequest $request)
    {
        //
        if (Auth::check()) {
            $agency = new Agency;
		    $agency->user_id = $request->user_id;
            $agency->commercial_register_name = $request->commercial_register_name;
            $agency->commercial_register_no = $request->commercial_register_no;
		    $agency->commercial_register_issuer = $request->commercial_register_issuer;
		    $agency->commercial_register_date = $request->commercial_register_date;
            $agency->commercial_register_exp_date = $request->commercial_register_exp_date;

            
            $agency->save();
            
            return response([ $this->modelname => new AgencyResource($agency)],Response::HTTP_CREATED);

        }else{
            return response()->json(["error"=>"There is no logined user"], Response::HTTP_UNAUTHORIZED);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Agency  $agency
     * @return \Illuminate\Http\Response
     */
    public function show(Agency $agency)
    {
        return [ $this->modelname => new AgencyResource($agency)];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Agency  $agency
     * @return \Illuminate\Http\Response
     */
    public function edit(Agency $agency)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Agency  $agency
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Agency $agency)
    {
        //
        if (Auth::check()) {
                $agency->update($request->all());
                return response([ $this->modelname => new AgencyResource($agency)],Response::HTTP_OK);
        }else{
            return response()->json(["error"=>"There is no logined user"], Response::HTTP_UNAUTHORIZED);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Agency  $agency
     * @return \Illuminate\Http\Response
     */
    public function destroy(Agency $agency)
    {
        $agency->delete();
        return response(null,Response::HTTP_NO_CONTENT);
    }

    

}

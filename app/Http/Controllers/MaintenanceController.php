<?php

namespace App\Http\Controllers;

use Auth;
use App;
use App\Maintenance;


use App\Http\Requests\MaintenanceRequest;
use App\Http\Resources\MaintenanceResource;

use Illuminate\Http\Response;
use Illuminate\Http\Request;

class MaintenanceController extends Controller
{

    private $modelname = "maintenance";
    private $modelnames = "maintenances";

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
        return [ $this->modelnames => MaintenanceResource::collection(Maintenance::get())];
    }

    public function indexByMProperty($id)
    {
        return [ $this->modelnames => MaintenanceResource::collection(Maintenance::Where('m_property_id',$id)->get())];
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

            $maintenance = Maintenance::create($data);            

            return [ $this->modelname => new MaintenanceResource($maintenance)];
        }else{
            return response()->json(["error"=>"There is no logined user"], Response::HTTP_UNAUTHORIZED);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Maintenance  $maintenance
     * @return \Illuminate\Http\Response
     */
    public function show(Maintenance $maintenance)
    {
        //
        return [ $this->modelname => new MaintenanceResource($maintenance)];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Maintenance  $maintenance
     * @return \Illuminate\Http\Response
     */
    public function edit(Maintenance $maintenance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Maintenance  $maintenance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        if (Auth::check()) {
            $data = (array) json_decode($request->request->get('data'));

            if ($request->hasFile('invoice_image')) {
                $file = $request->file('invoice_image');
                $extension = $file->getClientOriginalExtension();
                $invoice_fileName = str_random(20).".".$extension;
                $folderpath  = 'upload/maintenances/';
                $file->move($folderpath , $invoice_fileName);

                $data["invoice_image"] = $invoice_fileName;
            }

            $maintenance = Maintenance::find($id); 
            $maintenance->update($data);          

            return [ $this->modelname => new MaintenanceResource($maintenance)];
        }else{
            return response()->json(["error"=>"There is no logined user"], Response::HTTP_UNAUTHORIZED);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Maintenance  $maintenance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Maintenance $maintenance)
    {
        //
        $maintenance->delete();
        return response(null,Response::HTTP_NO_CONTENT);
    }
}

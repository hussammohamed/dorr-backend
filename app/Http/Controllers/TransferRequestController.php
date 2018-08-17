<?php

namespace App\Http\Controllers;

use Auth;
use App;
use App\TransferRequest;

use App\Http\Requests\TransferRequestRequest;
use App\Http\Resources\TransferRequestResource;

use Illuminate\Http\Response;
use Illuminate\Http\Request;

class TransferRequestController extends Controller
{

    private $modelname = "transfer_request";
    private $modelnames = "transfer_requests";

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
        return [ $this->modelnames => TransferRequestResource::collection(TransferRequest::get())];
    }

    public function indexByMProperty($id)
    {
        return [ $this->modelnames => TransferRequestResource::collection(TransferRequest::Where('m_property_id',$id)->get())];
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
                $folderpath  = 'upload/transfer_requests/';
                $file->move($folderpath , $image_fileName);
                $data["image"] = $image_fileName;
            }

            $data["status"] = 0;

            $transfer_request = TransferRequest::create($data);
            
            return [ $this->modelname => new TransferRequestResource($transfer_request)];
        }else{
            return response()->json(["error"=>"There is no logined user"], Response::HTTP_UNAUTHORIZED);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TransferRequest  $transferRequest
     * @return \Illuminate\Http\Response
     */
    public function show(TransferRequest $transfer_request)
    {
        //
        return [ $this->modelname => new TransferRequestResource($transfer_request)];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TransferRequest  $transferRequest
     * @return \Illuminate\Http\Response
     */
    public function edit(TransferRequest $transferRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TransferRequest  $transferRequest
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
                $folderpath  = 'upload/transfer_requests/';
                $file->move($folderpath , $image_fileName);
                $data["image"] = $image_fileName;
            }
            
            $transfer_request = TransferRequest::find($id); 

            $transfer_request->update($data);          

            return [ $this->modelname => new TransferRequestResource($transfer_request)];
        }else{
            return response()->json(["error"=>"There is no logined user"], Response::HTTP_UNAUTHORIZED);
        }
    }

    public function changeStatus($id,$status)
    {
        if (Auth::check()) {
            
            $transfer_request = TransferRequest::find($id); 
            $transfer_request->status = $status;
            $transfer_request->save();

            return response([ "$this->modelname" => new TransferRequestResource($transfer_request)],Response::HTTP_OK);
        }else{
            return response()->json(["error"=>"There is no logined user"], Response::HTTP_UNAUTHORIZED);
        }
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TransferRequest  $transferRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(TransferRequest $transfer_request)
    {
        //
        $transfer_request->delete();
        return response(null,Response::HTTP_NO_CONTENT);
    }
}

<?php

namespace App\Http\Controllers;

use App\PropertyReport;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\PropertyReportResource;

class PropertyReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function getByProperty($id){
        //

        $property_reports = PropertyReport::where('property_id',$id)->get();
        return PropertyReportResource::collection($property_reports);
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
        
            $report = new PropertyReport;
            $report->property_id = $request->property_id;
            $report->comment = $request->comment;
            $report->user_id = Auth::user()->id;
            
            $report->save();

            return redirect('/Properties/show/'.$property_id);
        
    }


    public function storeAPI(Request $request)
    {
        //
        if (Auth::check()) {
            $report = new PropertyReport;
            $report->property_id = $request->property_id;
            $report->comment = $request->comment;
            $report->user_id = Auth::user()->id;
            
            $report->save();

            return [
                'report_id' => $report->id,
                'comment' => $report->comment,
                'User' =>[
                    'id'=> Auth::user()->id,
                    'name'=> Auth::user()->name,
                    'phone'=> Auth::user()->mobile1,
                ],
            ];
        }else{
            return response()->json(["error"=>"There is no logined user"], Response::HTTP_UNAUTHORIZED);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PropertyReport  $propertyReport
     * @return \Illuminate\Http\Response
     */
    public function show(PropertyReport $propertyReport)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PropertyReport  $propertyReport
     * @return \Illuminate\Http\Response
     */
    public function edit(PropertyReport $propertyReport)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PropertyReport  $propertyReport
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PropertyReport $propertyReport)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PropertyReport  $propertyReport
     * @return \Illuminate\Http\Response
     */
    public function destroy(PropertyReport $propertyReport)
    {
        //
    }
}

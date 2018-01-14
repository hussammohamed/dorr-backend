<?php

namespace App\Http\Controllers;

use App;
use App\Purpose;
use App\Http\Resources\PurposesResource;
use Illuminate\Http\Request;

class PurposesController extends Controller
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Purposes  $purposes
     * @return \Illuminate\Http\Response
     */
    public function show(Purposes $purposes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Purposes  $purposes
     * @return \Illuminate\Http\Response
     */
    public function edit(Purposes $purposes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Purposes  $purposes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Purposes $purposes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Purposes  $purposes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Purposes $purposes)
    {
        //
    }
    
    public function getPurposes()
    {
        $purposes = Purpose::where('active','=', 1)->where('deleted','=', 0)->orderby('order')->get();
        return PurposesResource::collection($purposes);
    }
}

<?php

namespace App\Http\Controllers;

use App\ContractUnit;
use Illuminate\Http\Request;

class ContractUnitController extends Controller
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
     * @param  \App\ContractUnit  $contractUnit
     * @return \Illuminate\Http\Response
     */
    public function show(ContractUnit $contractUnit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ContractUnit  $contractUnit
     * @return \Illuminate\Http\Response
     */
    public function edit(ContractUnit $contractUnit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ContractUnit  $contractUnit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ContractUnit $contractUnit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ContractUnit  $contractUnit
     * @return \Illuminate\Http\Response
     */
    public function destroy(ContractUnit $contractUnit)
    {
        //
    }
    public function contractX()
    {
        $contract = ContractUnit::find(70)->contract;
        return $contract;
    }
}

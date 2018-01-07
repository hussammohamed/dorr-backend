<?php

namespace App\Http\Controllers;

use App;
use App\FilterMenu;
use App\Http\Resources\FilterMenuResource;
use Illuminate\Http\Request;

class FilterMenuController extends Controller
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
     * @param  \App\FilterMenu  $filterMenu
     * @return \Illuminate\Http\Response
     */
    public function show(FilterMenu $filterMenu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FilterMenu  $filterMenu
     * @return \Illuminate\Http\Response
     */
    public function edit(FilterMenu $filterMenu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FilterMenu  $filterMenu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FilterMenu $filterMenu)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FilterMenu  $filterMenu
     * @return \Illuminate\Http\Response
     */
    public function destroy(FilterMenu $filterMenu)
    {
        //
    }

    public function getFilterMenus()
    {
        $filters = FilterMenu::select('id', 'name_'.App::getLocale().' as name', 'type', 'purpose')
        ->where('active','=', 1)->where('deleted','=', 0)->orderby('order')->get();
        return FilterMenuResource::collection($filters);
    }
}

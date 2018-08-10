@extends('layouts.app')
    @section('header')
    <filters-component :filtersmenus="{{json_encode($filtermenus)}}"></filters-component>
    @endsection
    @section('content')
    <map-component :uproperties="{{json_encode($properties)}}" :cities="{{json_encode($cities)}}" :form="{{json_encode($request)}}"></map-component>
    <properties-component   ></properties-component>
    @endsection
    @push('headerScript')

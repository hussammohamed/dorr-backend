@extends('layouts.app')
    @section('header')
    <filters-component :filtersmenus="{{json_encode($filtermenus)}}"></filters-component>
    @endsection
    @section('content')
   
    <properties-component :cities="{{json_encode($cities)}}" :form="{{json_encode($request)}}" :uproperties="{{json_encode($properties)}}"></properties-component>
    @endsection
    @push('begScripts')
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCuaq7NJkSDoz9ORGZzVopdHK6X-m8F6qs">
    </script>
    @endpush

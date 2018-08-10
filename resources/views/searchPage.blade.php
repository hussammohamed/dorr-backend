@extends('layouts.app')
    @section('header')
    <filters-component :filtersmenus="{{json_encode($filtermenus)}}"></filters-component>
    @endsection
    @section('content')
    <map-component :uproperties="{{json_encode($properties)}}" :cities="{{json_encode($cities)}}" :form="{{json_encode($request)}}"></map-component>
    <properties-component   ></properties-component>
    @endsection
    @push('headerScript')
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCuaq7NJkSDoz9ORGZzVopdHK6X-m8F6qs">
    </script>
        <script type="text/javascript" src="{{ asset('js/customMarker.js') }}"></script>
    @endpush
    <script src="/js/echo.min.js"></script>
    <script>
  echo.init({
    offset: 100,
    throttle: 250,
    unload: false,
    callback: function (element, op) {
      console.log(element, 'has been', op + 'ed')
    }
  });

  // echo.render(); is also available for non-scroll callbacks
  </script>

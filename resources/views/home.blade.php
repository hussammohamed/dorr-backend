@extends('layouts.app') 
@section('header')  
<filters-component  :filtersmenus="{{json_encode($filterMenus)}}"></filters-component>
@endsction
@endsection @section('content') 
<map-component :cities="{{json_encode($cities)}}"></map-component>

<div class="content">
        @if(!$featuredProperties->isEmpty())
    <div class="group-ad">
        <div class="group-ad__header">
            <h6 class="group-ad__title">إعلانات مميزة</h6>
            <a href="#" class="group-ad__more">المزيد</a>
        </div>
        <div class="mdl-grid">
            @foreach($featuredProperties as $property)
            <div class="mdl-cell mdl-cell--3-col ">
                @include('components.vCard')
            </div>
            @endforeach
        </div>
    </div>
    @endif
    @if(!$latestProperties->isEmpty())
    <div class="group-ad">
        <div class="group-ad__header">
            <h6 class="group-ad__title">إحدث العروض</h6>
            <a href="#" class="group-ad__more">المزيد</a>
        </div>
        <div class="mdl-grid">
            @foreach($latestProperties as $property)
            <div class="mdl-cell mdl-cell--3-col">
                @include('components.vCard')
            </div>
            @endforeach
        </div>
    </div>
    @endif
    @include('components.appsDownload') @include('components.ourServices')
</div>

@endsection
@push('headerScript')
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCuaq7NJkSDoz9ORGZzVopdHK6X-m8F6qs">
    </script>
        <script type="text/javascript" src="{{ asset('js/customMarker.js') }}"></script>
    @endpush
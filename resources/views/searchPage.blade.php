@extends('layouts.app')
    @section('header')
    @include('components.mapFilters')
    @endsection
    @section('content')
    @include('components.mapSet')
    <div class="content">
    @include('components.propertySorts')
    <div class="grid">
    @foreach ($properties as $property)
        @include('components.hCard')
        @endforeach
    </div>
    </div>

    @endsection

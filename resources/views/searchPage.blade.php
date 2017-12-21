@extends('layouts.app')
    @section('header')
    @include('components.mapFilters')
    @endsection
    @section('content')
    @include('components.mapSet')
    <div class="content">
    @include('components.propertySorts')
    <div class="grid">
        @include('components.hCard')
        @include('components.hCard')
        @include('components.hCard')
    </div>
    </div>

    @endsection

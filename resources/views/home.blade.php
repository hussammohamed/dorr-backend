@extends('layouts.app')
    @section('header')
        @include('components.mapFilters')
    @endsection
    @section('content')
    @include('components.mapSet')
    <div class="content">
    <div class="group-ad">
    <div class="group-ad__header">
        <h6 class="group-ad__title">إعلانات مميزة</h6>      
        <a href="#" class="group-ad__more">المزيد</a>

            </div>
        <div class="mdl-grid">
            <div class="mdl-cell mdl-cell--3-col">
                @include('components.vCard')
            </div>
            <div class="mdl-cell mdl-cell--3-col">
                @include('components.vCard')
            </div>
            <div class="mdl-cell mdl-cell--3-col">
                @include('components.vCard')
            </div>
            <div class="mdl-cell mdl-cell--3-col">
                @include('components.vCard')
            </div>
        </div>
        </div>
        <div class="group-ad">
    <div class="group-ad__header">
        <h6 class="group-ad__title">إحدث العروض</h6>      
        <a href="#" class="group-ad__more">المزيد</a>

            </div>
        <div class="mdl-grid">
            <div class="mdl-cell mdl-cell--3-col">
                @include('components.vCard')
            </div>
            <div class="mdl-cell mdl-cell--3-col">
                @include('components.vCard')
            </div>
            <div class="mdl-cell mdl-cell--3-col">
                @include('components.vCard')
            </div>
            <div class="mdl-cell mdl-cell--3-col">
                @include('components.vCard')
            </div>
        </div>
        </div>
        @include('components.appsDownload')
    </div>
        
    @endsection

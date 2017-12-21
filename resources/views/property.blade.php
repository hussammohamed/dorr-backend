@extends('layouts.app')
    @section('header')
    @endsection
    @section('content')

    
    <div class="content">
        <div class="page-header">
            <div class="mdl-grid">
                <div class="mdl-cell mdl-cell--9-col">
                    <div class="mdl-color-text--grey-500 page-breadcrumb">
                         شقق للإيجار&gt;  الرياض &gt; حى المروج
                    </div>
                </div>
                <div class="mdl-cell mdl-cell--3-col mdl-color-text--grey-500">
                    <i class="material-icons">access_time</i>
                    <span class="page-date"> اخر تحديث فى 26 أكتوبر 2017</span>
                </div>
                <h4 class="page-title mdl-cell mdl-cell--12-col">شقة للإيجار فى شارع بن  الطرائفى</h4>
            </div>
       
        </div> 
        <div class="mdl-grid">
            <div class="mdl-cell mdl-cell--9-col">
                <div class="mdl-card  mdl-shadow--2dp u-auto-width u-mbuttom16">
    
                </div>
                <div class="mdl-card  mdl-shadow--2dp u-auto-width u-mbuttom16">

                </div>
                <div class="mdl-card  mdl-shadow--2dp u-auto-width u-mbuttom16">

                </div>

                </div> 
            <div class="mdl-cell mdl-cell--3-col">
                <div class="mdl-card  mdl-shadow--2dp u-auto-width u-mbuttom16">
                <table class="mdl-data-table u-full-width u-no-border">
                <tbody>
                  <tr >
                    <td class="u-no-border-top" width="8%">145م</td>
                    <td class="u-no-border-top" width="2%"><i class="material-icons">space_bar</i></td>
                    <td class="u-no-border-top">المساحة</td>
                  </tr>
                </tbody>
              </table>
                </div>
                <div class="mdl-card  mdl-shadow--2dp u-auto-width u-mbuttom16">

                </div>
                <div class="mdl-card  mdl-shadow--2dp u-auto-width u-mbuttom16">

                </div>
            </div> 
        </div>
        <div class="group-ad">
            <div class="group-ad__header">
                <h6 class="group-ad__title">إعلانات مشابهة</h6>      
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
    </div>

    @endsection

@push('scripts')
@endpush
@push('styles')

@endpush
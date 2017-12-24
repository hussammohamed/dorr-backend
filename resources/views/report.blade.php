@extends('layouts.app') @section('header') @endsection @section('content')
<div class="content">
    <form action="#">
        <div class="mdl-grid search-area--s">
            <div class="mdl-cell mdl-cell--3-col">
                <div class="mdl-textfield mdl-js-textfield getmdl-select__fullwidth u-full-width  mdl-textfield--floating-label getmdl-select getmdl-select__fix-height">
                    <input class="mdl-textfield__input" type="text" id="city2" value="" readonly tabIndex="-1">
                    <label for="city2">
                        <i class="mdl-icon-toggle__label material-icons">keyboard_arrow_down</i>
                    </label>
                    <label for="city2" class="mdl-textfield__label">المدينة </label>
                    <ul for="city2" class="mdl-menu mdl-menu--bottom-left mdl-js-menu">
                        <li class="mdl-menu__item" data-val="DE">مكة</li>
                        <li class="mdl-menu__item" data-val="BY">المدينة</li>
                        <li class="mdl-menu__item" data-val="RU">الرياض</li>
                    </ul>
                </div>
            </div>
            <div class="mdl-cell mdl-cell--3-col">
                <div class="mdl-textfield mdl-js-textfield getmdl-select__fullwidth u-full-width  mdl-textfield--floating-label getmdl-select getmdl-select__fix-height">
                    <input class="mdl-textfield__input" type="text" id="sample13" value="" readonly tabIndex="-1">
                    <label for="sample13">
                        <i class="mdl-icon-toggle__label material-icons">keyboard_arrow_down</i>
                    </label>
                    <label for="sample13" class="mdl-textfield__label">الحي</label>
                    <ul for="sample13" class="mdl-menu mdl-menu--bottom-left mdl-js-menu">
                        <li class="mdl-menu__item" data-val="DE">مكة</li>
                        <li class="mdl-menu__item" data-val="BY">المدينة</li>
                        <li class="mdl-menu__item" data-val="RU">الرياض</li>
                    </ul>
                </div>
            </div>
            <div class="mdl-cell mdl-cell--2-col">
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label u-full-width">
                    <input class="mdl-textfield__input date" type="text" id="lowPrice2">
                    <label class="mdl-textfield__label" for="lowPrice2">الفترة من</label>
                </div>
            </div>
            <div class="mdl-cell mdl-cell--2-col">
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label u-full-width">
                    <input class="mdl-datepicker__input mdl-textfield__input date" type="text" id="date-input" value="" />
                    <label class="mdl-textfield__label" for="date-input">الفترة الى</label>
                </div>
            </div>
            <div class="mdl-cell mdl-cell--2-col">
                <button id="" class="mdl-button u-fix-btn u-full-width mdl-js-button mdl-js-ripple-effect mdl-button--raised mdl-button--colored">
                    عرض التقرير
                </button>
            </div>

        </div>
    </form>
    <div class="mdl-card u-full-width mdl-shadow--2dp report-card u-mbuttom30">
        <div class="mdl-grid">
            <div class="repor-content">
                <h6 class="title">اسعار العقارات فى</h6>
                <h5>حى الروضة (الرياض)</h5>
                <h1>180,000</h1>
                <h6>متوسط السعرالمتر</h6>
                <div class="report-content-actions">
                    <button id="" class="mdl-button u-full-width mdl-js-button mdl-js-ripple-effect mdl-button--raised mdl-button--colored">
                        ابحث عن عقار 
                    </button>
                    <button id="" class="mdl-button u-text-color u-secondary-base-bg u-full-width mdl-js-button mdl-js-ripple-effect mdl-button--raised ">
                        أضف عقار
                    </button>
                </div>

            </div>
            <div class="mdl-cell mdl-cell--8-col">
                <canvas class="report-chart" height="500" width="1050" id="myChart"></canvas>
            </div>
        </div>
    </div>


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
    @include('components.appsDownload') @include('components.ourServices')
</div>

@endsection @push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.3.0/Chart.bundle.js"></script>
<script src={{ asset( 'js/jquery.datetimepicker.full.min.js')}}></script>
<script>
    $('.date').datetimepicker({
        timepicker: false,
        format: 'd.m.Y'
    });
    var canvas = document.getElementById('myChart');
    var data = {
        labels: ["January", "February", "March", "April", "May", "June", "July", "August", "Septemper", "October"],
        datasets: [
            {
                label: false,
                fill: false,
                lineTension: 0.5,
                backgroundColor: "rgba(75,192,192,0.4)",
                borderColor: "rgba(75,192,192,1)",
                borderCapStyle: 'butt',
                borderDash: [],
                borderDashOffset: 0.0,
                borderJoinStyle: 'miter',
                pointBorderColor: "rgba(75,192,192,1)",
                pointBackgroundColor: "rgba(75,192,192,1)",
                pointBorderWidth: 1,
                pointHoverRadius: 1,
                pointHoverBackgroundColor: "rgba(75,192,192,1)",
                pointHoverBorderColor: "rgba(220,220,220,1)",
                pointHoverBorderWidth: 10,
                pointRadius: 3,
                pointHitRadius: 25,
                data: [-40, 18, 20, 38, -55, 18, 19, 22, 65, 0],
            }
        ]
    };
    var option = {
        showLines: true,
        label: false,
        legend: {
            display: false
        }
    };
    var myLineChart = Chart.Line(canvas, {
        data: data,
        options: option,
        layout: {
            padding: {
                left: 0,
                right: 0,
                top: 0,
                bottom: 0
            }
        },

    });
</script> @endpush @push('styles')
<link rel="stylesheet" href={{ asset( 'css/jquery.datetimepicker.css')}}> @endpush
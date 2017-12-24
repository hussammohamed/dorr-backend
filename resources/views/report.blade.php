@extends('layouts.app') @section('header') @endsection @section('content')
<div class="content">
    <div class="mdl-card u-full-width " height="500">
        <div class="mdl-grid">
            <div class="mdl-cell mdl-cell--8-col">
                <canvas id="myChart"></canvas>
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
<script>
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
        label: false
    };
    var myLineChart = Chart.Line(canvas, {
        data: data,
        options: option
    });
</script> @endpush
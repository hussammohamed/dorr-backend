@extends('layouts.app') 
@section('header')  
<filters-component  :filtersmenus="{{json_encode($filterMenus)}}"></filters-component>
@endsction
@endsection @section('content') 
<map-component :cities="{{json_encode($cities)}}"></map-component>

<div class="content">
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
    @include('components.appsDownload') @include('components.ourServices')
</div>

@endsection @push('scripts')

<script src="https://www.gstatic.com/firebasejs/5.3.0/firebase.js"></script>
<script>
  // Initialize Firebase
  var config = {
    apiKey: "AIzaSyDvN0Pywabdl8U8J2hxM0b32h7ErOZuXZ8",
    authDomain: "dorr-app.firebaseapp.com",
    databaseURL: "https://dorr-app.firebaseio.com",
    projectId: "dorr-app",
    storageBucket: "dorr-app.appspot.com",
    messagingSenderId: "243311451130"
  };
  firebase.initializeApp(config);
</script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js"></script>
<script type="text/javascript" src={{ asset( 'js/owl.carousel.rtl.js')}} /></script>
<script>
$(".filter-map").owlCarouselRtl({
        dotsData: false,
        nav: true,
        items: 10
    });
</script> @endpush @push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.theme.min.css"> @endpush
@push('begScripts')
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCuaq7NJkSDoz9ORGZzVopdHK6X-m8F6qs">
    </script>
        <script type="text/javascript" src="{{ asset('js/customMarker.js') }}"></script>
    @endpush
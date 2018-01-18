@extends('layouts.app') @section('header') @endsection @section('content')
<div class="content">
    <!-- @include('components.propertySorts') -->
    <div class="grid">
        <div class="mdl-cell mdl-cell--12-col">
        @foreach($properties as $property)
            <div class="card horizontal mdl-card mdl-shadow--2dp h-card">
            <a href="/properties/show/{{$property->id}}" class="card-link"></a>
                <button id="{{$property->id}}"
                    class="mdl-button  h-card-actions mdl-js-button mdl-button--icon">
                    <i class="material-icons">settings</i>
            </button>
            
            <ul class="mdl-menu mdl-menu--bottom-left mdl-menu--custom mdl-js-menu mdl-js-ripple-effect"
                for="{{$property->id}}">
              <li class="mdl-menu__item"><a href="/properties/edit/{{$property->id}}"><i class="material-icons md-18">mode_edit</i> <span>تعديل</span></a> </li>
              <li class="mdl-menu__item mdl-menu__item--full-bleed-divider"> <i class="material-icons md-18">delete</i><span>حذف</span> </li>
            </ul>
                <div class="card-image">
                @if($property->featured == 1)
                <div  class="featured" >
                        <i class="material-icons">star</i>
                    </div>
                    @endif
                @forelse(App\PropertyImage::where('property_id','=', $property->id)->get() as  $image => $value)
                    @if($image == 0)
                        <img src={{ asset ('/upload/properties') }}/{{$value->path}} alt="">
                    @endif
                    @empty
                        <img src="/images/card1.png" alt="">
                    @endforelse
                </div>
                <div class="card-stacked">
                    <div class="card-content">
                        <h5 class="card--title">{{$property->title}}</h5>
                        <h6 class="card--sub-title">{{$property->address}}</h6>
                        <p class="card--text">{{$property->description}}</p>
                        <p>
                            <span class="card--text__size"> {{$property->area}} م
                                <sup>2</sup>
                            </span>
                    </div>
                    <div class="card-footer">
                        <div class="card-footer__price">
                            <span class="price--text">
                            {{$property->price}} ريال
                            </span>
                        </div>
                        <div class="footer-contet">
                            <span>{{$property->bathrooms}}</span>
                            <img src={{ asset( 'images/bathroom.svg')}} alt="">
                            <span>{{$property->rooms}}</span>
                            <i class="material-icons md-18">local_hotel</i>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

@endsection
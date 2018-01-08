<div class="mdl-cell mdl-cell--12-col">
    <div class="card horizontal mdl-card mdl-shadow--2dp h-card">
    <a href="{{ url('/') }}/Properties/show/{{$property->id}}" class="card-link"></a>
        <div class="card-image">
        @foreach(App\PropertyImage::where('property_id','=', $property->id)->get() as  $image => $value)
       @if($image == 0)
        <img src={{ url('/').'/upload/properties/'.$value->path }} alt="">
        @endif
       @endforeach
            
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
</div>
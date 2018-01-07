<div class="mdl-card mdl-shadow--2dp v-card">
    <a href="/Properties/show/{{$property->id}}" class="card-link"></a>
    <div class="card--item card--item__img">
        <img src={{ asset( 'images/card1.png') }} alt="">
    </div>
    <div class="card--item card--item__text">
        <h5 class="card--text__title">{{$property->title}}</h5>
        <p class="card--text__address">{{$property->description}}</p>
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
    <span class="card-hover--bar"></span>
</div>
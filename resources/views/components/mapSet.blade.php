<div id="mapConainer" class="map-container">

<div id="map" class="map">
 
</div>
<button id="hideMap" class="mdl-button hide-map-btn mdl-js-button mdl-js-ripple-effect mdl-button--raised ">
  <i class="material-icons">map</i>
  إخفاء الخريطة
</button>
<div id="searchArea" class="map-serach mdl-card mdl-shadow--2dp">
<form action="properties/search" method="POST">
  <div class="serach-textfield">
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--slim">
      <input class="mdl-textfield__input" name="keyword" type="text" id="mapSearch">
      <label class="mdl-textfield__label" for="mapSerach">بحث</label>
      <i class="material-icons u-flip search-icon">search</i>
    </div>
  </div>
  <div class="collapse-btn" id="searchBtn">
    <i class="material-icons"></i>
  </div>
<div class="mdl-grid ">
  <div class="mdl-cell mdl-cell--6-col mdl-cell--12-col-tablet">
    <div class="mdl-textfield mdl-js-textfield getmdl-select__fullwidth u-full-width  mdl-textfield--floating-label getmdl-select getmdl-select__fix-height">

      <input id="cityId" class="mdl-textfield__input city_id_js" type="text" value="" readonly tabIndex="-1">
      <input  type="hidden" class="hidden-input"  name="city"  value="" >
      <label for="cityId">


        <i class="mdl-icon-toggle__label material-icons">keyboard_arrow_down</i>
      </label>
      <label for="cityId" class="mdl-textfield__label">المدينة</label>
      <ul for="cityId" class="mdl-menu mdl-menu--bottom-left mdl-js-menu">
      @foreach ($cities as $city)
        <li class="mdl-menu__item" data-val="{{$city->id}}">{{$city->$name}}</li>
        @endforeach
      </ul>
    </div>
  </div>
  <div class="mdl-cell mdl-cell--6-col mdl-cell--12-col-tablet">
    <div class="mdl-textfield mdl-js-textfield getmdl-select__fullwidth u-full-width  mdl-textfield--floating-label  getmdl-select__city  getmdl-select getmdl-select__fix-height">
      <input class="mdl-textfield__input" type="text" id="district" value="" readonly tabIndex="-1">
      <input  type="hidden" name="district"  value="" >
      <label for="district">

        <i class="mdl-icon-toggle__label material-icons">keyboard_arrow_down</i>
      </label>
      <label for="district" class="mdl-textfield__label">الحي</label>
      <ul for="district" class="mdl-menu mdl-menu--bottom-left mdl-js-menu">
        <li  v-for="city in cities" v-text="city.title" tabindex="-1" class="mdl-menu__item" :data-val="city.id"></li>
      </ul>
    </div>
  </div>
  <div class="mdl-cell mdl-cell--6-col mdl-cell--12-col-tablet">
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label u-full-width">
      <input class="mdl-textfield__input" name="priceFrom" type="text" id="lowPrice">
      <label class="mdl-textfield__label" for="lowPrice">أقل سعر</label>
    </div>
  </div>
  <div class="mdl-cell mdl-cell--6-col mdl-cell--12-col-tablet">
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label u-full-width">
      <input class="mdl-textfield__input" name="priceTo" type="text" id="hPrice">
      <label class="mdl-textfield__label" for="hPrice">أعلى سعر</label>
    </div>
  </div>
  <button type="submit" class="mdl-button u-full-width  mdl-js-button mdl-js-ripple-effect mdl-button--raised mdl-button--colored">
    بحث
  </button>
</div>
</form>
</div>


<form action="properties/search" method="POST">
<div class="mdl-grid search-area--s">
  <div class="mdl-cell mdl-cell--2-col">
    <div class="mdl-textfield mdl-js-textfield ">
      <input class="mdl-textfield__input" name="keyword" type="text" id="mapSearch2">
      <label class="mdl-textfield__label" for="mapSerach2">بحث</label>
    </div>
  </div>
  <div class="mdl-cell mdl-cell--2-col">
    <div class="mdl-textfield mdl-js-textfield getmdl-select__fullwidth u-full-width  mdl-textfield--floating-label  getmdl-select getmdl-select__fix-height">
      <input class="mdl-textfield__input  city_id_js" type="text" id="city2" value="" readonly tabIndex="-1">
      <input  type="hidden" class="hidden-input"  value=""  name="city">
      <label for="city2">
        <i class="mdl-icon-toggle__label material-icons">keyboard_arrow_down</i>
      </label>
      <label for="city2" class="mdl-textfield__label">المدينة </label>
      <ul for="city2" class="mdl-menu mdl-menu--bottom-left mdl-js-menu">
      @foreach ($cities as $city)
      <li class="mdl-menu__item" data-val="{{$city->id}}">{{$city->$name}}</li>
      @endforeach
      </ul>
    </div>
  </div>
  <div class="mdl-cell mdl-cell--2-col">
    <div class="mdl-textfield mdl-js-textfield getmdl-select__fullwidth u-full-width  mdl-textfield--floating-label getmdl-select__city getmdl-select getmdl-select__fix-height">
      <input class="mdl-textfield__input" type="text" id="sample13" value="" readonly tabIndex="-1">
      <input  type="hidden"  value="" >
      <label for="sample13">
        <i class="mdl-icon-toggle__label material-icons">keyboard_arrow_down</i>
      </label>
      <label for="sample13" class="mdl-textfield__label">الحي</label>
      <ul for="sample13" class="mdl-menu mdl-menu--bottom-left mdl-js-menu">
      <li  v-for="city in cities" v-text="city.title" tabindex="-1" class="mdl-menu__item" :data-val="city.id"></li>
      </ul>
    </div>
  </div>
  <div class="mdl-cell mdl-cell--2-col">
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label u-full-width">
      <input class="mdl-textfield__input" name="priceFrom" type="text" id="lowPrice2">
      <label class="mdl-textfield__label" for="lowPrice2">أقل سعر</label>
    </div>
  </div>
  <div class="mdl-cell mdl-cell--2-col">
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label u-full-width">
      <input class="mdl-textfield__input" name="priceTo"  type="text" id="hPrice2">
      <label class="mdl-textfield__label" for="hPrice2">أعلى سعر</label>
    </div>
  </div>
  <div class="mdl-cell mdl-cell--2-col">
      <button id="" class="mdl-button u-full-width mdl-js-button mdl-js-ripple-effect mdl-button--raised mdl-button--colored">
          بحث
        </button>    
  </div>
  
</div>
</form>
</div>


@push('scripts')
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCuaq7NJkSDoz9ORGZzVopdHK6X-m8F6qs">
</script>
<script>
var bathroom = '{!! asset('images/bathroom.svg') !!}';
</script>
<script type="text/javascript" src="{{ asset('js/customMarker.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/map.js') }}"></script> @endpush
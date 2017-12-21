<div class="map-container">
  <div id="map" class="map"></div>
  <div class="map-serach mdl-card mdl-shadow--2dp">
      <div class="mdl-grid">
        <div class="mdl-cell mdl-cell--10-col">
          <div class="mdl-textfield mdl-js-textfield ">
            <input class="mdl-textfield__input" type="text" id="mapSearch" >
            <label class="mdl-textfield__label" for="mapSerach">بحث</label>
            <!-- <i class="material-icons u-flip search-icon">search</i> -->
          </div>
        </div>
        <div class="collapse-btn mdl-cell mdl-cell--2-col ">
          <i class="material-icons"></i>
        </div>
      </div>
      <div>
        <select class="initialized-select">
          <option value="1">الرياض</option>
          <option value="2">المدينة</option>
        </select>
      </div>
  </div>
</div>


@push('scripts')
<script type="text/javascript"
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCuaq7NJkSDoz9ORGZzVopdHK6X-m8F6qs">
    </script>
    <script type="text/javascript" src="{{ asset('js/customMarker.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/map.js') }}"></script>
@endpush
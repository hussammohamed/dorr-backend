<div class="map-container">
<div id="map" class="map"></div>
</div>


@push('scripts')
<script type="text/javascript"
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCuaq7NJkSDoz9ORGZzVopdHK6X-m8F6qs">
    </script>
    <script type="text/javascript" src="{{ asset('js/customMarker.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/map.js') }}"></script>
   
@endpush
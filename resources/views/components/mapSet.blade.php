<div class="map-container">
<div id="map" class="map"></div>
</div>


@push('scripts')
    <script src="{{ asset('js/map.js') }}"></script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCuaq7NJkSDoz9ORGZzVopdHK6X-m8F6qs&callback=initMap">
    </script>
@endpush
<div class="filter-map">
    <div class="filter-map__item">
    @foreach ($filterMenus as $filterMenu)
    <!-- filter-map__selected -->
    <button class="mdl-button mdl-js-button mdl-js-ripple-effect filter-map__button ">
    {{$filterMenu->$name}}
    </button>
    @endforeach
   </div>
</div>
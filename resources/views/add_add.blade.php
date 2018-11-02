@extends('layouts.app') @section('header') @endsection @section('content')

<div class="content content-padding">

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form id="properties-form" class="wizard-form" action="/properties/store" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div>
            <h3 class="hidden">first_step</h3>
            <section>
                <div class="section-header">
                    <h3>أضف اعلان</h3>
                </div>

                <div class="mdl-card mdl-shadow--2dp u-height-auto u-full-width mdl-grid u-mbuttom30">
                    <div class="mdl-cell mdl-cell--6-col">
                        <div class="mdl-textfield mdl-js-textfield getmdl-select__fullwidth u-full-width  mdl-textfield--floating-label getmdl-select getmdl-select__fix-height">
                            <input class="mdl-textfield__input" tabIndex="1" required name="typeLabel" type="text" id="type" value=""
                                readonly>
                            <input value="" class="select-input__js" type="hidden" name="type" />
                            <label for="type">
                                <i class="mdl-icon-toggle__label material-icons">keyboard_arrow_down</i>
                            </label>
                            <label for="type" class="mdl-textfield__label">نوع العقار</label>
                            <ul for="type" id="typesContainer" class="mdl-menu mdl-menu--bottom-left mdl-js-menu">
                                @foreach($types as $type)
                                <li class="mdl-menu__item" data-val="{{$type->id}}">{{$type->$name}}</li>
                                @endforeach

                            </ul>
                        </div>
                    </div>
                    <div class="mdl-cell mdl-cell--6-col">
                        <div class="mdl-textfield mdl-js-textfield u-full-width  mdl-textfield--floating-label getmdl-select getmdl-select__fix-height">
                            <input class="mdl-textfield__input" tabIndex="2" required name="purposeLabel" value="" type="text" id="purpose"
                                readonly>
                            <input value="" class="select-input__js" type="hidden" name="purpose" />
                            <label for="purpose">
                                <i class="mdl-icon-toggle__label material-icons">keyboard_arrow_down</i>
                            </label>
                            <label for="purpose" class="mdl-textfield__label">الغرض من العرض</label>
                            <ul for="purpose" id="purposesContainer" class="mdl-menu mdl-menu--bottom-left u-full-width mdl-js-menu">
                                @foreach($purposes as $purpose)
                                <li class="mdl-menu__item" data-val="{{$purpose->id}}">{{$purpose->$name}}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </section>
            <h3 class="hidden">second_step</h3>
            <section class="u-hidden">
                <div class="section-header">
                    <h3>تفاصيل العنوان</h3>
                </div>

                <div class="mdl-card mdl-shadow--2dp u-full-width mdl-grid u-mbuttom30">
                    <div class="mdl-cell mdl-cell--6-col">
                        <div class="mdl-textfield mdl-js-textfield u-full-width  mdl-textfield--floating-label getmdl-select getmdl-select__fix-height">
                            <input class="mdl-textfield__input city_id_js" tabIndex="3" required type="text" id="cityId" value=""
                                readonly tabIndex="-1">
                            <input value="" class="hidden-input" type="hidden" />
                            <label for="cityId">
                                <i class="mdl-icon-toggle__label material-icons">keyboard_arrow_down</i>
                            </label>
                            <label for="cityId" class="mdl-textfield__label">المدينة</label>
                            <ul for="cityId" id="cityContianer" class="mdl-menu mdl-menu--bottom-left u-full-width mdl-js-menu">
                                @foreach($cities as $city)
                                <li class="mdl-menu__item" data-lat='{{$city->lat}}' data-long='{{$city->long}}'
                                    data-val="{{$city->id}}">{{$city->$name}}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="mdl-cell mdl-cell--6-col mdl-cell--12-col-tablet">
                        <div class="mdl-textfield mdl-js-textfield getmdl-select__fullwidth u-full-width  mdl-textfield--floating-label  getmdl-select__city  getmdl-select getmdl-select__fix-height">
                            <input class="mdl-textfield__input" required tabIndex="4" type="text" id="district" value="" readonly
                                tabIndex="-1">
                            <input type="hidden" name="region" required value="">
                            <label for="district">
                                <i class="mdl-icon-toggle__label material-icons">keyboard_arrow_down</i>
                            </label>
                            <label for="district" class="mdl-textfield__label">الحي</label>
                            <ul for="district" id="districtContianer" class="mdl-menu mdl-menu--bottom-left mdl-js-menu">

                            </ul>
                        </div>
                    </div>
                    <div class="mdl-cell mdl-cell--8-col">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label u-full-width">
                            <input class="mdl-textfield__input" required tabIndex="5" name="address" type="text" id="mapSearch"
                                placeholder="">
                            <label class="mdl-textfield__label" for="mapSearch">العنوان بالتفصيل</label>
                            <input class="mdl-textfield__input" required type="hidden" name="lat" id="lat" placeholder="">
                            <input class="mdl-textfield__input" required type="hidden" id="long" name="long"
                                placeholder="">
                        </div>
                    </div>
                    <div class="mdl-cell mdl-cell--4-col">
                        <div class="mdl-textfield mdl-js-textfield u-full-width  mdl-textfield--floating-label getmdl-select getmdl-select__fix-height">
                            <input class="mdl-textfield__input" required  tabIndex="6" type="text" id="map_view" value="" readonly
                                tabIndex="-1">
                            <input value="" class="hidden-input" type="hidden" name="map_view" />
                            <label for="map_view">
                                <i class="mdl-icon-toggle__label material-icons">keyboard_arrow_down</i>
                            </label>
                            <label for="map_view" class="mdl-textfield__label">طريقة ظهور العقار</label>
                            <ul for="map_view" class="mdl-menu mdl-menu--bottom-left u-full-width mdl-js-menu">
                                @foreach($mapViews as $mapView)
                                <li class="mdl-menu__item" data-val="{{$mapView->id}}">{{$mapView->$name}}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div id="map"></div>
                    <div class="valid-map u-error-color hidden">يجب تحديد الموقع على الخريطه</div>
                    <div class="map-link">
                        يمكنك تحديد العنوان من موقع
                        <a href="https://maps.address.gov.sa/" target="_blank"> خرائط العنوان الوطني السعودي</a>
                    </div>
                </div>
                <div class="section-header">
                    <h3>تفاصيل العقار</h3>
                </div>

                <div class="mdl-card mdl-shadow--2dp u-full-width mdl-grid u-mbuttom30">
                    <div class="mdl-cell mdl-cell--3-col">
                        <div class="mdl-textfield mdl-js-textfield getmdl-select__fullwidth u-full-width  mdl-textfield--floating-label getmdl-select getmdl-select__fix-height">
                            <input class="mdl-textfield__input" tabIndex="7" required type="text" id="advertiser_type" value=""
                                readonly tabIndex="-1">
                            <input value="" type="hidden" name="advertiser_type" />
                            <label for="advertiser_type">
                                <i class="mdl-icon-toggle__label material-icons">keyboard_arrow_down</i>
                            </label>
                            <label for="advertiser_type" class="mdl-textfield__label">العلاقة بالعقار</label>
                            <ul for="advertiser_type" class="mdl-menu mdl-menu--bottom-left mdl-js-menu">
                                @foreach($advertiserTypes as $advertiserType)
                                <li class="mdl-menu__item" data-val="{{$advertiserType->id}}">{{$advertiserType->$name}}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="mdl-cell mdl-cell--3-col">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label u-full-width">
                            <input class="mdl-textfield__input" tabIndex="8" required name="area" type="number" id="sample9">
                            <label class="mdl-textfield__label" for="sample9">المساحة بالمتر المربع</label>
                        </div>
                    </div>
                    <!-- <div class="mdl-cell mdl-cell--3-col">
                        <div class="mdl-textfield mdl-js-textfield getmdl-select__fullwidth u-full-width  mdl-textfield--floating-label getmdl-select getmdl-select__fix-height">
                            <input class="mdl-textfield__input" required type="text" id="sample12" value="" readonly tabIndex="-1">
                            <input value="" type="hidden" name="payment_methods" />
                            <label for="sample1">
                                <i class="mdl-icon-toggle__label material-icons">keyboard_arrow_down</i>
                            </label>
                            <label for="sample12" class="mdl-textfield__label">طريقة الدفع</label>
                            <ul for="sample12" class="mdl-menu mdl-menu--bottom-left mdl-js-menu">
                                @foreach($paymentMethods as $paymentMethod)
                                <li class="mdl-menu__item" data-val="{{$paymentMethod->id}}">{{$paymentMethod->$name}}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div> -->
                    <div class="mdl-cell mdl-cell--6-col">
                        <div class="dropdown-mul-2" tabIndex="9">
                            <input type="hidden" id="overlooks"  name="overlooks">
                            <select style="display:none" id="mul-2"  multiple placeholder="الوجهات ">
                                @foreach($overlooks as $overlook)
                                <option value="{{$overlook->id}}">{{$overlook->$name}}</option>
                                @endforeach
                            </select>
                        </div>


                    </div>
                    <div class="mdl-cell mdl-cell--3-col target-sale">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label u-full-width">
                            <input class="mdl-textfield__input" tabIndex="10" name="bid_price" type="number" id="bid_price">
                            <label class="mdl-textfield__label" for="bid_price">سعر السوم</label>
                        </div>
                    </div>
                    <div class="mdl-cell mdl-cell--3-col target-rent hidden">
                        <div class="mdl-textfield mdl-js-textfield getmdl-select__fullwidth u-full-width  mdl-textfield--floating-label getmdl-select getmdl-select__fix-height">
                            <input class="mdl-textfield__input" name="typeLabel" type="text" id="period" value=""
                                readonly>
                            <input value="" type="hidden" name="period" />
                            <label for="period">
                                <i class="mdl-icon-toggle__label material-icons">keyboard_arrow_down</i>
                            </label>
                            <label for="period" class="mdl-textfield__label">الأيجار</label>
                            <ul for="period" class="mdl-menu mdl-menu--bottom-left mdl-js-menu">
                                @foreach($incomePeriods as $incomePeriod)
                                <li class="mdl-menu__item" data-val="{{$incomePeriod->id}}">{{$incomePeriod->$name}}</li>
                                @endforeach

                            </ul>
                        </div>
                    </div>
                    <div class="mdl-cell mdl-cell--3-col">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label u-full-width">
                            <input class="mdl-textfield__input" required name="price" type="number" id="price">
                            <label class="mdl-textfield__label target-sale " tabIndex="11" for="price">السعر المطلوب للبيع</label>
                            <label class="mdl-textfield__label target-rent" tabIndex="11" for="price">السعر المطلوب للأيجار</label>
                        </div>
                        <span class="mdl-color-text--grey-500 u-text-size-10"> مهم لظهور عقارك بالبحث ولن يظهر في العرض</span>
                    </div>
                    <div class="mdl-cell mdl-cell--3-col mdl-checkbox-col target-sale">
                        <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="price_view">
                            <input type="hidden" name="price_view" value="0" />
                            <input type="checkbox" id="price_view" tabIndex="12" value="1" name="price_view" class="mdl-checkbox__input">
                            <span class="price_view">إخفاء السعر</span>
                        </label>
                    </div>


                    <div class="mdl-cell mdl-cell--3-col">
                        <div class="mdl-textfield mdl-js-textfield getmdl-select__fullwidth u-full-width  mdl-textfield--floating-label">
                            <input class="mdl-textfield__input" name="rooms" type="number" id="rooms" value="">
                            <label for="rooms" class="mdl-textfield__label">عدد الغرف</label>
                        </div>
                    </div>
                    <div class="mdl-cell mdl-cell--3-col">
                        <div class="mdl-textfield mdl-js-textfield getmdl-select__fullwidth u-full-width  mdl-textfield--floating-label">
                            <input class="mdl-textfield__input" name="bathrooms" type="number" id="bathrooms" value="">
                            <label for="bathrooms" class="mdl-textfield__label"> عدد الحمامات</label>
                        </div>
                    </div>
                    <div class="mdl-cell mdl-cell--3-col">
                        <div class="mdl-textfield mdl-js-textfield getmdl-select__fullwidth u-full-width  mdl-textfield--floating-label">
                            <input class="mdl-textfield__input" name="floor" type="number" id="floor" value="">
                            <label class="mdl-textfield__label target-villa " for="price">عدد الطوابق</label>
                            <label class="mdl-textfield__label target-apartment" for="price">الطابق</label>
                            <label for="floor" class="mdl-textfield__label"></label>
                        </div>
                    </div>

                    <div class="mdl-cell mdl-cell--3-col">
                        <div class="mdl-textfield mdl-js-textfield getmdl-select__fullwidth u-full-width  mdl-textfield--floating-label ">
                            <input class="mdl-textfield__input" name="year_of_construction" type="number" id="sampl6"
                                value="">

                            <label for="sampl6" class="mdl-textfield__label">سنة البناء</label>

                        </div>
                    </div>
                    <div class="mdl-cell mdl-cell--3-col mdl-checkbox-col ">
                        <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="whatsapp_permisson">
                            <input type="hidden" name="allow_whatsapp" value="0" />
                            <input type="checkbox" id="whatsapp_permisson" checked value="1" name="allow_whatsapp"
                                class="mdl-checkbox__input">
                            <span class="price_view">التواصل عبر الواتس</span>
                        </label>
                    </div>
                    <div class="mdl-cell mdl-cell--3-col mdl-checkbox-col ">
                        <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="add_comments">
                            <input type="hidden" name="allow_comments" value="0" />
                            <input type="checkbox" id="add_comments" value="1" checked name="allow_comments" class="mdl-checkbox__input">
                            <span class="price_view">إضافة تعليقات</span>
                        </label>
                    </div>
                    <div class="mdl-cell mdl-cell--3-col mdl-checkbox-col ">
                        <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="privet_chat">
                            <input type="hidden" name="allow_private" value="0" />
                            <input type="checkbox" id="privet_chat" value="1" checked name="allow_private" class="mdl-checkbox__input">
                            <span class="price_view">التواصل على الخاص</span>
                        </label>
                    </div>
                    <!-- <div class="mdl-cell mdl-cell--3-col">
                        <div class="mdl-textfield mdl-js-textfield getmdl-select__fullwidth u-full-width  mdl-textfield--floating-label mdl-textfield--floating-label getmdl-select getmdl-select__fix-height">

                            <input class="mdl-textfield__input" required type="text" id="sampl7" value="" readonly tabIndex="-1">
                            <input value="" type="hidden" name="finish_type" />
                            <label for="sampl7">
                                <i class="mdl-icon-toggle__label material-icons">keyboard_arrow_down</i>
                            </label>
                            <label for="sampl7" class="mdl-textfield__label">نوع التشطيب</label>
                            <ul for="sampl7" class="mdl-menu mdl-menu--bottom-left mdl-js-menu">
                                @foreach($finishTypes as $finishType)
                                <li class="mdl-menu__item" data-val="{{$finishType->id}}">{{$finishType->$name}}</li>
                                @endforeach
                            </ul>

                        </div>
                    </div> -->
                </div>
                <div class="section-header">
                    <h3>تفاصيل الأعلان</h3>
                </div>

                <div class="mdl-card mdl-shadow--2dp u-full-width mdl-grid u-mbuttom30">
                    <div class="mdl-cell mdl-cell--12-col">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label u-full-width">
                            <input class="mdl-textfield__input" required name="title" type="text" id="sample20">
                            <label class="mdl-textfield__label" for="sample20">عنوان الأعلان</label>
                        </div>
                    </div>
                    <div class="mdl-cell mdl-cell--12-col">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label u-full-width">
                            <textarea class="mdl-textfield__input" name="description" type="text" rows="5" id="sample5"></textarea>
                            <label class="mdl-textfield__label" for="sample5">تفاصيل الأعلان</label>
                        </div>
                    </div>
                </div>
            </section>
            <h3 class="hidden">third_step</h3>
            <section class="u-hidden">
                <div class="section-header">
                    <h3>صور العقار</h3>
                </div>
                <div class="mdl-card mdl-shadow--2dp u-full-width mdl-grid u-mbuttom30">
                    <div class="mdl-cell mdl-cell--12-col p-y-1">
                        <div class=" m-b-1">
                            <div class="form-group inputDnD">
                                <i class="material-icons">add_a_photo</i>
                                <input type="file" accept="image/jpeg, image/png" class="form-control-file text-primary font-weight-bold"
                                    id="inputFile" accept="image/*" onchange="readUrl(this)" data-title="اسحب الصورة هنا للإضافة"
                                    name="attachment[]" multiple>
                                <button type="button" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--raised mdl-button--colored"
                                    onclick="document.getElementById('inputFile').click()">او إرفاق صور</button>
                            </div>
                        </div>

                    </div>
                    <div id="files" class="mdl-cell mdl-cell--12-col"></div>
                </div>
                <div class="section-header">
                    <h3>أضف فيديو</h3>
                </div>
                <div class="mdl-card mdl-shadow--2dp u-full-width mdl-grid u-mbuttom30 u-height-auto">
                    <div class="mdl-cell mdl-cell--12-col">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label u-full-width">
                            <input class="mdl-textfield__input" name="youtube" type="text" id="youtube">
                            <label class="mdl-textfield__label" for="youtube">رابط الفيديو (يوتيوب) </label>
                        </div>
                    </div>
                </div>
                <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="checkbox-1">
                    <input type="checkbox" id="checkbox-1" name="checkbox[]" class="mdl-checkbox__input">
                    <span class="mdl-checkbox__label">موافق على الشروط والأحكام</span>
                </label>
            </section>
        </div>
    </form>
</div>

@endsection @push('scripts')
<script src={{ asset( 'js/jquery.steps.min.js') }}></script>
<script src={{ asset( 'js/jquery.dropdown.min.js') }}></script>
<script type="text/javascript" src="{{ asset('js/addproperty.js') }}"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCuaq7NJkSDoz9ORGZzVopdHK6X-m8F6qs&libraries=places&&language=ar"></script>
@endpush
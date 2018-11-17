@extends('layouts.app') @section('header') @endsection @section('content')
<div class="content content-padding">
    <div class="group-ad">
        <div class="group-ad__header">
            <h6 class="group-ad__title">حسابي</h6>
        </div>
        <div class="mdl-card mdl-shadow--2dp u-full-width u-mbuttom30 u-padding-bottom-25 u-padding-top-15">

            <div class="mdl-card__title">
                الصورة الشخصية
            </div>
            <div class="u-center">
                <div class="avatar-item-circle"><img :src="imgDataUrl"></div>
                <a class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--raised mdl-button--colored u-center"
                    @click="toggleShow">تغير</a>
            </div>
        </div>
        <form id="user-form" class="wizard-form" action="myAccount/update" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="mdl-card mdl-shadow--2dp u-full-width u-mbuttom30 u-padding-bottom-25 u-padding-top-15">

                <div class="mdl-card__title">
                    المعلومات الشخصية
                </div>
                <div class="mdl-grid ">
                    <!-- <div class="mdl-cell mdl-cell--6-col">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label u-full-width">
                            <input class="mdl-textfield__input" type="text" id="first_name" name="first_name" value="{{ $user[0]->first_name }}">
                            <label class="mdl-textfield__label" for="first_name">الأسم الأول</label>
                        </div>
                    </div>
                    <div class="mdl-cell mdl-cell--6-col">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label u-full-width">
                            <input class="mdl-textfield__input" type="text" id="family_name" name="family_name" value="{{ $user[0]->family_name }}">
                            <label class="mdl-textfield__label" for="family_name">أسم العائلة</label>
                        </div>
                    </div> -->

                    <div class="mdl-cell mdl-cell--6-col">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label u-full-width">
                            <input class="mdl-textfield__input" type="text" id="name" name="name" value="{{ $user[0]->name }}">
                            <label class="mdl-textfield__label" for="name">الأسم بالكامل</label>
                        </div>
                    </div>
                    <div class="mdl-cell mdl-cell--6-col">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label u-full-width">
                            <input class="mdl-textfield__input" type="text" id="address" name="address" value="{{ $user[0]->address }}">
                            <label class="mdl-textfield__label" for="address">العنوان</label>
                        </div>
                    </div>
                    <div class="mdl-cell mdl-cell--6-col">
                        <div class="mdl-textfield mdl-js-textfield getmdl-select__fullwidth u-full-width  mdl-textfield--floating-label getmdl-select getmdl-select__fix-height">
                            <input class="mdl-textfield__input" required type="text" id="id_type" value="" readonly>
                            <input value="" type="hidden" name="id_type" />
                            <label for="id_type">
                                <i class="mdl-icon-toggle__label material-icons">keyboard_arrow_down</i>
                            </label>
                            <label for="id_type" class="mdl-textfield__label">نوع الهوية</label>
                            <ul for="id_type" id="typesContainer" class="mdl-menu mdl-menu--bottom-left mdl-js-menu">
                                @foreach($idTypes as $type) @if ($type->id == $user[0]->id_type)
                                <li class="mdl-menu__item" data-val="{{$type->id}}" data-selected="true">{{$type->$name}}</li>
                                @else
                                <li class="mdl-menu__item" data-val="{{$type->id}}">{{$type->$name}}</li>
                                @endif @endforeach
                            </ul>
                        </div>
                    </div>


                    <div class="mdl-cell mdl-cell--6-col">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label u-full-width">
                            <input class="mdl-textfield__input" type="text" id="id_no" name="id_no" value="{{ $user[0]->id_no }}">
                            <label class="mdl-textfield__label" for="id_no">رقم الهوية</label>
                        </div>
                    </div>
                    <div class="mdl-cell mdl-cell--6-col">
                        <div class="mdl-textfield mdl-js-textfield getmdl-select__fullwidth u-full-width  mdl-textfield--floating-label getmdl-select getmdl-select__fix-height">
                            <input class="mdl-textfield__input" required type="text" id="id_issuer" value="" readonly>
                            <input value="" type="hidden" name="id_issuer" />
                            <label for="id_issuer">
                                <i class="mdl-icon-toggle__label material-icons">keyboard_arrow_down</i>
                            </label>
                            <label for="id_issuer" class="mdl-textfield__label">جهة الأصدار</label>
                            <ul for="id_issuer" class="mdl-menu mdl-menu--bottom-left mdl-js-menu">
                                @foreach($regions as $type) @if ($type->id == $user[0]->id_issuer)
                                <li class="mdl-menu__item" data-val="{{$type->id}}" data-selected="true">{{$type->$name}}</li>
                                @else
                                <li class="mdl-menu__item" data-val="{{$type->id}}">{{$type->$name}}</li>
                                @endif @endforeach
                            </ul>
                        </div>
                    </div>

                    <div class="mdl-cell mdl-cell--6-col">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label u-full-width">
                            <input type="date" class="mdl-textfield__input" type="text" id="id_issued_date" name="id_issued_date"
                                value="{{ $user[0]->id_issued_date }}">
                            <label class="mdl-textfield__label" for="id_issued_date">تاريخ الأصدار</label>
                        </div>
                    </div>
                    <div class="mdl-cell mdl-cell--6-col">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label u-full-width">
                            <input type="date" class="mdl-textfield__input" type="text" id="id_exp_date" name="id_exp_date"
                                value="{{ $user[0]->id_exp_date }}">
                            <label class="mdl-textfield__label" for="id_exp_date ">تاريخ الأنتهاء</label>
                        </div>
                    </div>
                    <div class="mdl-cell mdl-cell--6-col">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label u-full-width">
                            <input class="mdl-textfield__input" type="text" id="Useremail" name="email" value="{{ $user[0]->email }}">
                            <label class="mdl-textfield__label" for="Useremail">البريد الألكتروني</label>
                        </div>
                    </div>
                    <!-- <div class="mdl-cell mdl-cell--6-col">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label u-full-width">
                            <input class="mdl-textfield__input" type="text" id="phone" name="phone" value="{{ $user[0]->phone }}">
                            <label class="mdl-textfield__label" for="phone">رقم التليفون</label>
                        </div>
                    </div> -->
                    <div class="mdl-cell mdl-cell--6-col">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label u-full-width">
                            <input class="mdl-textfield__input" type="text" id="mobile1" name="mobile1" value="{{ $user[0]->mobile1 }}">
                            <label class="mdl-textfield__label" for="mobile1">رقم الجوال</label>
                        </div>
                    </div>
                    <!-- <div class="mdl-cell mdl-cell--6-col">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label u-full-width">
                            <input class="mdl-textfield__input" type="text" id="mobile2" name="mobile2" value="{{ $user[0]->mobile2 }}">
                            <label class="mdl-textfield__label" for="mobile2">رقم جوال أخر</label>
                        </div>
                    </div> -->
                    <div class="mdl-cell mdl-cell--6-col">
                        <div class="mdl-textfield mdl-js-textfield getmdl-select__fullwidth u-full-width  mdl-textfield--floating-label getmdl-select getmdl-select__fix-height">
                            <input class="mdl-textfield__input" required type="text" id="nationality" value="" readonly>
                            <input value="" type="hidden" name="nationality" />
                            <label for="nationality">
                                <i class="mdl-icon-toggle__label material-icons">keyboard_arrow_down</i>
                            </label>
                            <label for="nationality" class="mdl-textfield__label"> الجنسية</label>
                            <ul for="nationality" class="mdl-menu mdl-menu--bottom-left mdl-js-menu">
                                @foreach($nationalities as $type) @if ($type->id == $user[0]->nationality)
                                <li class="mdl-menu__item" data-val="{{$type->id}}" data-selected="true">{{$type->$name}}</li>
                                @else
                                <li class="mdl-menu__item" data-val="{{$type->id}}">{{$type->$name}}</li>
                                @endif @endforeach
                            </ul>
                        </div>
                    </div>

                    <div class="mdl-cell mdl-cell--6-col">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label u-full-width">
                            <input class="mdl-textfield__input" type="text" id="bank_iban" name="bank_iban" value="{{ $user[0]->bank_iban }}">
                            <label class="mdl-textfield__label" for="bank_iban">رقم الحساب البنكي IBAN</label>
                        </div>
                    </div>
                    <div class="mdl-cell mdl-cell--6-col">
                        <div class="mdl-textfield mdl-js-textfield getmdl-select__fullwidth u-full-width  mdl-textfield--floating-label getmdl-select getmdl-select__fix-height">
                            <input class="mdl-textfield__input" required type="text" id="bank" value="" readonly>
                            <input value="" type="hidden" name="bank" />
                            <label for="bank">
                                <i class="mdl-icon-toggle__label material-icons">keyboard_arrow_down</i>
                            </label>
                            <label for="bank" class="mdl-textfield__label"> البنك الخاص</label>
                            <ul for="bank" class="mdl-menu mdl-menu--bottom-left mdl-js-menu">
                                @foreach($banks as $type) @if ($type->id == $user[0]->bank)
                                <li class="mdl-menu__item" data-val="{{$type->id}}" data-selected="true">{{$type->$name}}</li>
                                @else
                                <li class="mdl-menu__item" data-val="{{$type->id}}">{{$type->$name}}</li>
                                @endif @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="mdl-cell mdl-cell--12-col md-padding">
                        <div class=" m-b-1 ">
                            <div class="form-group inputDnD md-80">
                                <i class="material-icons">insert_drive_file</i>
                                <input type="file" onchange="getImageTitle(this)" accept="image/*" data-title="مرفق صورة الهوية"
                                    id="inputFile" name="id_image" class="form-control-file text-primary font-weight-bold">
                                @if ($user[0]->id_image)
                                <a href="upload/users/id/{{$user[0]->id_image}}" class="" target="_blank">عرض</a>
                                @endif
                            </div>
                        </div>

                    </div>

                </div>
                <div class="u-center">
                    <!-- <button type="button" class="mdl-button">دخول</button> -->

                    <button type="submit" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--raised mdl-button--colored u-center u-min-width-180">حفظ
                        التغيرات</button>
                </div>
            </div>

        </form>
    @if (count($agency) > 0)
        <form id="current-agency" class="wizard-form" action="myAccount/updateAgency" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="mdl-card mdl-shadow--2dp u-full-width u-mbuttom30 u-padding-bottom-25 u-padding-top-15">

                <div class="mdl-card__title">
                    بيانات السجل التجاري
                </div>
                <div class="mdl-grid ">
                    <div class="mdl-cell mdl-cell--6-col">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label u-full-width">
                            <input class="mdl-textfield__input" type="text" id="commercial_register_name" name="commercial_register_name" value="{{ $agency[0]->commercial_register_name }}">
                            <label class="mdl-textfield__label" for="commercial_register_name">الأسم </label>
                        </div>
                    </div>
                    <div class="mdl-cell mdl-cell--6-col">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label u-full-width">
                            <input class="mdl-textfield__input" type="number" id="commercial_register_no" name="commercial_register_no" value="{{ $agency[0]->commercial_register_no }}">
                            <label class="mdl-textfield__label" for="commercial_register_no">رقم السجل التجاري </label>
                        </div>
                    </div>
                    <div class="mdl-cell mdl-cell--6-col">
                        <div class="mdl-textfield mdl-js-textfield getmdl-select__fullwidth u-full-width  mdl-textfield--floating-label getmdl-select getmdl-select__fix-height">
                            <input class="mdl-textfield__input" required type="text" id="commercial_register_issuer" value="" readonly>
                            <input value="" type="hidden" name="commercial_register_issuer" />
                            <label for="commercial_register_issuer">
                                <i class="mdl-icon-toggle__label material-icons">keyboard_arrow_down</i>
                            </label>
                            <label for="commercial_register_issuer" class="mdl-textfield__label">جهة الأصدار</label>
                            <ul for="commercial_register_issuer" class="mdl-menu mdl-menu--bottom-left mdl-js-menu">
                                @foreach($regions as $type) @if ($type->id == $agency[0]->commercial_register_issuer)
                                <li class="mdl-menu__item" data-val="{{$type->id}}" data-selected="true">{{$type->$name}}</li>
                                @else
                                <li class="mdl-menu__item" data-val="{{$type->id}}">{{$type->$name}}</li>
                                @endif @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="mdl-cell mdl-cell--6-col">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label u-full-width">
                            <input class="mdl-textfield__input" type="text" id="commercial_register_address" name="commercial_register_address" value="{{ $agency[0]->commercial_register_address }}">
                            <label class="mdl-textfield__label" for="commercial_register_address">العنوان</label>
                        </div>
                    </div>
                    <div class="mdl-cell mdl-cell--6-col">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label u-full-width">
                            <input type="date" class="mdl-textfield__input" type="text" id="commercial_register_date" name="commercial_register_date"
                                value="{{$agency[0]->commercial_register_date }}">
                            <label class="mdl-textfield__label" for="commercial_register_date">تاريخ الأصدار</label>
                        </div>
                    </div>
                    <div class="mdl-cell mdl-cell--6-col">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label u-full-width">
                            <input type="date" class="mdl-textfield__input" type="text" id="commercial_register_exp_date" name="commercial_register_exp_date"
                                value="{{$agency[0]->commercial_register_exp_date }}">
                            <label class="mdl-textfield__label" for="commercial_register_exp_date ">تاريخ الأنتهاء</label>
                        </div>
                    </div>
                    <div class="mdl-cell mdl-cell--6-col">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label u-full-width">
                            <input class="mdl-textfield__input" type="text" id="phone" name="phone" value="{{ $agency[0]->phone }}">
                            <label class="mdl-textfield__label" for="phone">رقم الجوال</label>
                        </div>
                    </div>
                    <div class="mdl-cell mdl-cell--6-col">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label u-full-width">
                            <input class="mdl-textfield__input" type="text" id="fax" name="fax" value="{{ $agency[0]->fax }}">
                            <label class="mdl-textfield__label" for="fax">رقم الفاكس</label>
                        </div>
                    </div>
                    <div class="mdl-cell mdl-cell--12-col md-padding">
                        <div class=" m-b-1 ">
                            <div class="form-group inputDnD md-80">
                                <i class="material-icons">insert_drive_file</i>
                                <input type="file" onchange="getImageTitle(this)" accept="image/*" data-title="مرفق السجل التجاري"
                                    id="commercial_register_image" name="commercial_register_image" class="form-control-file text-primary font-weight-bold">
                                @if ($user[0]->id_image)
                                <a href="upload/users/id/{{$user[0]->id_image}}" class="" target="_blank">عرض</a>
                                @endif
                            </div>
                        </div>

                    </div>


                </div>
                <div class="u-center">
                    <!-- <button type="button" class="mdl-button">دخول</button> -->

                    <button type="submit" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--raised mdl-button--colored u-center u-min-width-180">حفظ
                        التغيرات</button>
                </div>
            </div>

        </form>
        @else
        <form id="current-agency" class="wizard-form" action="myAccount/createAgency" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="mdl-card mdl-shadow--2dp u-full-width u-mbuttom30 u-padding-bottom-25 u-padding-top-15">

                <div class="mdl-card__title">
                    بيانات السجل التجاري
                </div>
                <div class="mdl-grid ">
                    <div class="mdl-cell mdl-cell--6-col">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label u-full-width">
                            <input class="mdl-textfield__input" type="text" id="commercial_register_name" name="commercial_register_name" value="">
                            <label class="mdl-textfield__label" for="commercial_register_name">الأسم </label>
                        </div>
                    </div>
                    <div class="mdl-cell mdl-cell--6-col">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label u-full-width">
                            <input class="mdl-textfield__input" type="number" id="commercial_register_no" name="commercial_register_no" value="">
                            <label class="mdl-textfield__label" for="commercial_register_no">رقم السجل التجاري </label>
                        </div>
                    </div>
                    <div class="mdl-cell mdl-cell--6-col">
                        <div class="mdl-textfield mdl-js-textfield getmdl-select__fullwidth u-full-width  mdl-textfield--floating-label getmdl-select getmdl-select__fix-height">
                            <input class="mdl-textfield__input" required type="text" id="commercial_register_issuer" value="" readonly>
                            <input value="" type="hidden" name="commercial_register_issuer" />
                            <label for="commercial_register_issuer">
                                <i class="mdl-icon-toggle__label material-icons">keyboard_arrow_down</i>
                            </label>
                            <label for="commercial_register_issuer" class="mdl-textfield__label">جهة الأصدار</label>
                            <ul for="commercial_register_issuer" class="mdl-menu mdl-menu--bottom-left mdl-js-menu">
                                @foreach($regions as $type) 
                                <li class="mdl-menu__item" data-val="{{$type->id}}">{{$type->$name}}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="mdl-cell mdl-cell--6-col">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label u-full-width">
                            <input class="mdl-textfield__input" type="text" id="commercial_register_address" name="commercial_register_address" value="">
                            <label class="mdl-textfield__label" for="commercial_register_address">العنوان</label>
                        </div>
                    </div>
                    <div class="mdl-cell mdl-cell--6-col">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label u-full-width">
                            <input type="date" class="mdl-textfield__input" type="text" id="commercial_register_date" name="commercial_register_date"
                                value="">
                            <label class="mdl-textfield__label" for="commercial_register_date">تاريخ الأصدار</label>
                        </div>
                    </div>
                    <div class="mdl-cell mdl-cell--6-col">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label u-full-width">
                            <input type="date" class="mdl-textfield__input" type="text" id="commercial_register_exp_date" name="commercial_register_exp_date"
                                value="">
                            <label class="mdl-textfield__label" for="commercial_register_exp_date ">تاريخ الأنتهاء</label>
                        </div>
                    </div>
                    <div class="mdl-cell mdl-cell--6-col">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label u-full-width">
                            <input class="mdl-textfield__input" type="text" id="phone" name="phone" value="">
                            <label class="mdl-textfield__label" for="phone">رقم الجوال</label>
                        </div>
                    </div>
                    <div class="mdl-cell mdl-cell--6-col">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label u-full-width">
                            <input class="mdl-textfield__input" type="text" id="fax" name="fax" value="">
                            <label class="mdl-textfield__label" for="fax">رقم الفاكس</label>
                        </div>
                    </div>
                    <div class="mdl-cell mdl-cell--12-col md-padding">
                        <div class=" m-b-1 ">
                            <div class="form-group inputDnD md-80">
                                <i class="material-icons">insert_drive_file</i>
                                <input type="file" onchange="getImageTitle(this)" accept="image/*" data-title="مرفق السجل التجاري"
                                    id="commercial_register_image" name="commercial_register_image" class="form-control-file text-primary font-weight-bold">
                                @if ($user[0]->id_image)
                                <a href="upload/users/id/{{$user[0]->id_image}}" class="" target="_blank">عرض</a>
                                @endif
                            </div>
                        </div>

                    </div>


                </div>
                <div class="u-center">
                    <!-- <button type="button" class="mdl-button">دخول</button> -->

                    <button type="submit" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--raised mdl-button--colored u-center u-min-width-180">حفظ
                        التغيرات</button>
                </div>
            </div>

        </form>
        @endif



        <form id="example-form" class="wizard-form" method="POST" action="myAccount/updatePassword">
            {{ csrf_field() }}
            <div class="mdl-card mdl-shadow--2dp u-full-width u-mbuttom30 u-padding-bottom-25 u-padding-top-15">
                <div class="mdl-card__title">
                    تغير كلمة المرور
                </div>
                <div class="mdl-grid ">
                    <div class="mdl-cell mdl-cell--12-col">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label u-full-width">
                            <input class="mdl-textfield__input" type="password" id="oldPass" name="oldPass">
                            <label class="mdl-textfield__label" for="oldPass">كلمة المرور الحالية</label>
                        </div>
                    </div>
                    <div class="mdl-cell mdl-cell--12-col">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label u-full-width">
                            <input class="mdl-textfield__input" type="password" id="newPass" name="newPass">
                            <label class="mdl-textfield__label" for="newPass">كلمة المرور الجديدة</label>
                        </div>
                    </div>
                    <div class="mdl-cell mdl-cell--12-col">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label u-full-width">
                            <input class="mdl-textfield__input" type="password" id="confirmNewPass" name="confirmNewPass">
                            <label class="mdl-textfield__label" for="confirmNewPass">تأكيد كلمة المرور</label>
                        </div>
                    </div>

                </div>

                <div class="u-center">
                    <!-- <button type="button" class="mdl-button">دخول</button> -->
                    <button type="submit" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--raised mdl-button--colored u-center u-min-width-180">تغير</button>
                </div>
            </div>
        </form>
    </div>

    <my-upload field="avatar" @crop-success="cropSuccess" @crop-upload-success="cropUploadSuccess" @crop-upload-fail="cropUploadFail"
        v-model="show" :width="100" :height="100" url="/api/v1/user/avatar/upload" :params="params" :headers="headers"
        lang-type="ar" img-format="png"></my-upload>
</div>

@endsection
@push('scripts')
<script>
    function getImageTitle(input) {


    }
</script>
@endpush
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
                <a class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--raised mdl-button--colored u-center" @click="toggleShow">تغير</a>       
            </div>
        </div>
        <form id="user-form" class="wizard-form" action="myAccount/update" method="post">
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
                            <input class="mdl-textfield__input" required  type="text" id="id_type" value="" readonly>
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
                            <input class="mdl-textfield__input" required  type="text" id="id_issuer" value="" readonly>
                            <input value="" type="hidden" name="id_issuer" />
                            <label for="id_issuer">
                                <i class="mdl-icon-toggle__label material-icons">keyboard_arrow_down</i>
                            </label>
                            <label for="id_issuer" class="mdl-textfield__label">جهة الأصدار</label>
                            <ul for="id_issuer"  class="mdl-menu mdl-menu--bottom-left mdl-js-menu">
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
                            <input type="date" class="mdl-textfield__input" type="text" id="id_issued_date" name="id_issued_date" value="{{ $user[0]->id_issued_date }}">
                            <label class="mdl-textfield__label" for="id_issued_date">تاريخ الأصدار</label>
                        </div>
                    </div>
                    <div class="mdl-cell mdl-cell--6-col">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label u-full-width">
                            <input type="date" class="mdl-textfield__input" type="text" id="id_exp_date" name="id_exp_date" value="{{ $user[0]->id_exp_date }}">
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
                            <input class="mdl-textfield__input" required  type="text" id="nationality" value="" readonly>
                            <input value="" type="hidden" name="nationality" />
                            <label for="nationality">
                                <i class="mdl-icon-toggle__label material-icons">keyboard_arrow_down</i>
                            </label>
                            <label for="nationality" class="mdl-textfield__label"> الجنسية</label>
                            <ul for="nationality"  class="mdl-menu mdl-menu--bottom-left mdl-js-menu">
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
                            <input class="mdl-textfield__input" required  type="text" id="bank" value="" readonly>
                            <input value="" type="hidden" name="bank" />
                            <label for="bank">
                                <i class="mdl-icon-toggle__label material-icons">keyboard_arrow_down</i>
                            </label>
                            <label for="bank" class="mdl-textfield__label"> البنك الخاص</label>
                            <ul for="bank"  class="mdl-menu mdl-menu--bottom-left mdl-js-menu">
                                @foreach($banks as $type) @if ($type->id == $user[0]->bank)
                                <li class="mdl-menu__item" data-val="{{$type->id}}" data-selected="true">{{$type->$name}}</li>
                                @else
                                <li class="mdl-menu__item" data-val="{{$type->id}}">{{$type->$name}}</li>
                                @endif @endforeach
                            </ul>
                        </div>
                    </div>

                </div>
                <div class="u-center">
                    <!-- <button type="button" class="mdl-button">دخول</button> -->

                    <button type="submit" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--raised mdl-button--colored u-center u-min-width-180">حفظ التغيرات</button>
                </div>
            </div>

        </form>
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
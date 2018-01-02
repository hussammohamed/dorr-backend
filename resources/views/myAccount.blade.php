@extends('layouts.app') @section('header') @endsection @section('content')
<div class="content content-padding">
    <div class="group-ad">
        <div class="group-ad__header">
            <h6 class="group-ad__title">حسابي</h6>
        </div>
        <form id="example-form" class="wizard-form" action="/myAccount/update" method="post">
            {{ csrf_field() }}
            <div class="mdl-card mdl-shadow--2dp u-full-width u-mbuttom30 u-padding-bottom-25 u-padding-top-15">
                <div class="mdl-card__title">
                    المعلومات الشخصية
                </div>
                <div class="mdl-grid ">
                    <div class="mdl-cell mdl-cell--6-col">
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
                    </div>
                    <div class="mdl-cell mdl-cell--12-col">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label u-full-width">
                            <input class="mdl-textfield__input" type="text" id="name" name="name" value="{{ $user[0]->name }}">
                            <label class="mdl-textfield__label" for="name">الأسم بالكامل</label>
                        </div>
                    </div>
                    <div class="mdl-cell mdl-cell--6-col">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label u-full-width">
                            <input class="mdl-textfield__input" type="text" id="email" name="email" value="{{ $user[0]->email }}">
                            <label class="mdl-textfield__label" for="email">البريد الألكتروني</label>
                        </div>
                    </div>
                    <div class="mdl-cell mdl-cell--6-col">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label u-full-width">
                            <input class="mdl-textfield__input" type="text" id="phone" name="phone" value="{{ $user[0]->phone }}">
                            <label class="mdl-textfield__label" for="phone">رقم التليفون</label>
                        </div>
                    </div>
                    <div class="mdl-cell mdl-cell--6-col">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label u-full-width">
                            <input class="mdl-textfield__input" type="text" id="mobile1" name="mobile1" value="{{ $user[0]->mobile1 }}">
                            <label class="mdl-textfield__label" for="mobile1">رقم الجوال</label>
                        </div>
                    </div>
                    <div class="mdl-cell mdl-cell--6-col">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label u-full-width">
                            <input class="mdl-textfield__input" type="text" id="mobile2" name="mobile2" value="{{ $user[0]->mobile2 }}">
                            <label class="mdl-textfield__label" for="mobile2">رقم جوال أخر</label>
                        </div>
                    </div>
                </div>
                <div class="u-center">
                    <!-- <button type="button" class="mdl-button">دخول</button> -->
                    
                    <button type="submit" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--raised mdl-button--colored u-center u-min-width-180">حفظ التغيرات</button>
                </div>
            </div>

        </form>
        <form id="example-form" class="wizard-form"  method="POST" action="/myAccount/updatePassword">
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


</div>

@endsection
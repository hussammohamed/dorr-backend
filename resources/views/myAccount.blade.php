@extends('layouts.app') @section('header') @endsection @section('content')
<div class="content content-padding">
    <div class="group-ad">
        <div class="group-ad__header">
            <h6 class="group-ad__title">حسابي</h6>
        </div>
        <form id="example-form" class="wizard-form" action="#">

            <div class="mdl-card mdl-shadow--2dp u-full-width u-mbuttom30 u-padding-bottom-25 u-padding-top-15">
                <div class="mdl-card__title">
                    المعلومات الشخصية
                </div>
                <div class="mdl-grid ">
                    <div class="mdl-cell mdl-cell--6-col">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label u-full-width">
                            <input class="mdl-textfield__input" type="text" id="sample20">
                            <label class="mdl-textfield__label" for="sample20">الأسم الأول</label>
                        </div>
                    </div>
                    <div class="mdl-cell mdl-cell--6-col">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label u-full-width">
                            <input class="mdl-textfield__input" type="text" id="sample5">
                            <label class="mdl-textfield__label" for="sample5">أسم العائلة</label>
                        </div>
                    </div>
                    <div class="mdl-cell mdl-cell--12-col">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label u-full-width">
                            <input class="mdl-textfield__input" type="text" id="sample5">
                            <label class="mdl-textfield__label" for="sample5">الأسم بالكامل</label>
                        </div>
                    </div>
                    <div class="mdl-cell mdl-cell--6-col">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label u-full-width">
                            <input class="mdl-textfield__input" type="text" id="sample5">
                            <label class="mdl-textfield__label" for="sample5">البريد الألكتروني</label>
                        </div>
                    </div>
                    <div class="mdl-cell mdl-cell--6-col">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label u-full-width">
                            <input class="mdl-textfield__input" type="text" id="sample5">
                            <label class="mdl-textfield__label" for="sample5">رقم التليفون</label>
                        </div>
                    </div>
                    <div class="mdl-cell mdl-cell--6-col">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label u-full-width">
                            <input class="mdl-textfield__input" type="text" id="sample5">
                            <label class="mdl-textfield__label" for="sample5">رقم الجوال</label>
                        </div>
                    </div>
                    <div class="mdl-cell mdl-cell--6-col">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label u-full-width">
                            <input class="mdl-textfield__input" type="text" id="sample5">
                            <label class="mdl-textfield__label" for="sample5">رقم جوال أخر</label>
                        </div>
                    </div>
                </div>
                <div class="u-center">
                    <!-- <button type="button" class="mdl-button">دخول</button> -->
                    <button type="button" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--raised mdl-button--colored u-center u-min-width-180">حفظ التغيرات</button>
                </div>
            </div>

        </form>
        <form id="example-form" class="wizard-form" action="#">

            <div class="mdl-card mdl-shadow--2dp u-full-width u-mbuttom30 u-padding-bottom-25 u-padding-top-15">
                <div class="mdl-card__title">
                    تغير كلمة المرور
                </div>
                <div class="mdl-grid ">
                    <div class="mdl-cell mdl-cell--12-col">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label u-full-width">
                            <input class="mdl-textfield__input" type="text" id="sample20">
                            <label class="mdl-textfield__label" for="sample20">كلمة المرور الحالية</label>
                        </div>
                    </div>
                    <div class="mdl-cell mdl-cell--12-col">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label u-full-width">
                            <input class="mdl-textfield__input" type="text" id="sample5">
                            <label class="mdl-textfield__label" for="sample5">كلمة المرور الجديدة</label>
                        </div>
                    </div>
                    <div class="mdl-cell mdl-cell--12-col">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label u-full-width">
                            <input class="mdl-textfield__input" type="text" id="sample20">
                            <label class="mdl-textfield__label" for="sample20">تأكيد كلمة المرور</label>
                        </div>
                    </div>

                </div>

                <div class="u-center">
                    <!-- <button type="button" class="mdl-button">دخول</button> -->
                    <button type="button" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--raised mdl-button--colored u-center u-min-width-180">تغير</button>
                </div>
            </div>
        </form>
    </div>


</div>

@endsection
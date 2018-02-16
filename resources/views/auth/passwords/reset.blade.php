@extends('layouts.app') @section('content')
<div class="content content-padding">
    <div class="group-ad">
        <div class="group-ad__header">
            <h6 class="group-ad__title"> تغير كلمة المرور</h6>
        </div>

        <form class="form-horizontal" method="POST" action="{{ route('password.request') }}">
            {{ csrf_field() }}
            <div class="mdl-card mdl-shadow--2dp u-full-width u-mbuttom30 u-padding-bottom-25 u-padding-top-15 {{ $errors->has('email') ? ' has-error' : '' }}">
                <div class="mdl-card__title">
                </div>

                <input type="hidden" name="token" value="{{ $token }}">
                <div class="mdl-grid ">
                    <div class="mdl-cell mdl-cell--12-col">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label u-full-width {{ $errors->has('email') ? 'is-invalid' : '' }}">
                            <input id="email" type="email" class="mdl-textfield__input" name="email" value="{{ $email or old('email') }}"  >
                            <label class="mdl-textfield__label" for="email">البريد الألكتروني</label>
                            @if ($errors->has('email'))
                            <span class="mdl-textfield__error">
                               {{ $errors->first('email') }}
                            </span>
                            @endif
                        </div>

                    </div>
                    <div class="mdl-cell mdl-cell--12-col">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label u-full-width {{ $errors->has('password') ? 'is-invalid' : '' }}">
                            <input id="password" type="password" class="mdl-textfield__input " name="password" >
                            <label class="mdl-textfield__label" for="password">كلمة المرور الجديدة</label>
                            @if ($errors->has('password'))
                            <span class="mdl-textfield__error">
                                {{ $errors->first('password') }}
                            </span>
                            @endif

                        </div>
                    </div>
                    <div class="mdl-cell mdl-cell--12-col">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label u-full-width {{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}">
                            <input id="password-confirm" type="password" class="mdl-textfield__input" name="password_confirmation" >
                            <label class="mdl-textfield__label" for="password-confirm">تأكيد كلمة المرور</label>
                            @if ($errors->has('password_confirmation'))
                            <span class="mdl-textfield__error">
                               {{ $errors->first('password_confirmation') }}
                            </span>
                            @endif
                        </div>
                    </div>

                </div>
                <div class="u-center">

                    <button type="submit" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--raised mdl-button--colored u-center u-min-width-180">تغير</button>
                </div>
                </div>
        </form>
        </div>


    </div>
    @endsection
<form   method="POST" action="{{ route('register') }}">
{{ csrf_field() }}
<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label u-full-width">
    <input class="mdl-textfield__input" type="text" name="name" value="{{ old('name') }}"   id="signupName">
    <label class="mdl-textfield__label" for="signupName">أسم المستخدم</label>
    <!-- <span class="mdl-textfield__error">Input is not a number!</span> -->
  </div>
  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label u-full-width">
    <input class="mdl-textfield__input" type="text" name="email" value="{{ old('email') }}"  id="signupEmail">
    <label class="mdl-textfield__label" for="signupEmail">البريد الألكترونى</label>
    <!-- <span class="mdl-textfield__error">Input is not a number!</span> -->
  </div>
  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label u-full-width">
    <input class="mdl-textfield__input " type="password"  name="password" id="signupPassword">
    <label class="mdl-textfield__label" for="signupPassword">كلمة المرور</label>
    <!-- <span class="mdl-textfield__error">Input is not a number!</span> -->
  </div>
  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label u-full-width">
    <input class="mdl-textfield__input " type="password"  name="password_confirmation"  id="signupPasswordConfirmation">
    <label class="mdl-textfield__label" for="signupPasswordConfirmation">تأكيد كلمة المرور</label>
    <!-- <span class="mdl-textfield__error">Input is not a number!</span> -->
  </div>
  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label u-full-width">
    <input class="mdl-textfield__input " type="text" name="mobile1"  id="signupPhone">
    <label class="mdl-textfield__label" for="signupPhone">رقم الجوال</label>
    <!-- <span class="mdl-textfield__error">Input is not a number!</span> -->
  </div>
  <div class="">
  <button type="submit" class="mdl-button u-mtop16 u-full-width mdl-js-button mdl-js-ripple-effect mdl-button--raised mdl-button--colored u-center">تسجيل</button>
</div>
</form>
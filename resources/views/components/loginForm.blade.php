<form method="POST" action="{{ route('login') }}">
{{ csrf_field() }}
  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label u-full-width">
    <input class="mdl-textfield__input" type="text" name="email" value="{{ old('email') }}"  id="email">
    <label class="mdl-textfield__label"  for="email">البريد الألكترونى أو رقم الجوال</label>
    <!-- <span class="mdl-textfield__error">Input is not a number!</span> -->
  </div>
  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label u-full-width">
    <input class="mdl-textfield__input " name="password" type="password"  id="password">
    <label class="mdl-textfield__label" for="password">كلمة المرور</label>
    <!-- <span class="mdl-textfield__error">Input is not a number!</span> -->
  </div>
  <div class="">

  <button type="submit" class="mdl-button u-mtop16 u-full-width mdl-js-button mdl-js-ripple-effect mdl-button--raised mdl-button--colored u-center">دخول</button>
</div>
</form>
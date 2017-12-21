<footer class="mdl-mega-footer l-footer">
            <div class="footer-bg"></div>
            <div class="mdl-mega-footer__middle-section mdl-grid footer__middle">
                <div class="mdl-cell mdl-cell--4-col  footer--item footer-item__center">
                    <img class="footer--item__logo" src={{ asset('images/dorr-logo.svg') }} alt="Dorr">    
                    <p>خدمات دور تساعد على بيع وشراء العقارات بسهولة بالإضافة إلى تزويدك بمعلومات أساسية لإتخاذ واحد من أهم القرارات المالية فى حياتك</p>
                </div>
               
                <div class="mdl-cell mdl-cell--2-col  footer--item">
                <h1 class="mdl-mega-footer__heading footer--item__heading">خدماتنا</h1>
                <ul class="mdl-mega-footer__link-list">
                    <li><a href="#">بحث عن عقارات</a></li>
                    <li><a href="#">إعلن عن عقارات</a></li>
                    <li><a href="#">إدارة العقارات</a></li>
                    <li><a href="#">تقارير الإسعار</a></li>
                    <li><a href="#">وساطة عقارية</a></li>
                </ul>
               
                </div>
                <div class="mdl-cell mdl-cell--2-col  footer--item">
                <h1 class="mdl-mega-footer__heading footer--item__heading">خدماتنا</h1>
                <ul class="mdl-mega-footer__link-list">
                    <li><a href="#">بحث عن عقارات</a></li>
                    <li><a href="#">إعلن عن عقارات</a></li>
                    <li><a href="#">إدارة العقارات</a></li>
                    <li><a href="#">تقارير الإسعار</a></li>
                    <li><a href="#">وساطة عقارية</a></li>
                    <li><a href="#">تقييم</a></li>
                </ul>
                </div>  

                
                <div class="mdl-cell mdl-cell--4-col footer--item footer-item__center">
                    <h3>تطبيق دور</h3>
                    <h6>حمل تطبيق دور على موبايلك وتمتع بجميع خدمات دور</h6>
                
                </div>
            </div>

            <div class="footer__bottom">
                <div class="">جميع الحقوق محفوظة - تطبيق عقار 2017</div>
            </div>

    </footer>
    <!-- dialogs -->

    <dialog class="mdl-dialog dialog" id="loginDialog">
    <div class="mdl-diaglog__head">
    <div class="mdl-dialog__text">
        <h5>تسجيل دخول</h5>
         <p>سجل حساب جديد فى تطبيق دور</p>
         <p>إذا كنت غير مسجل قم بـ <a href="#" id="signupBtn">تسجيل حساب جديد</a></p>
    </div>
    <div class="mdl-dialog__logo">
        <div class="bg"></div>
    <img  src={{ asset('images/dorr-logo.svg') }} alt="Dorr">
    </div>
    </div>
    
    <div class="mdl-dialog__content">
         @include('components.loginForm')
    </div>
    <div class="mdl-dialog__actions mdl-dialog__actions--full-width">
        <!-- <button type="button" class="mdl-button">دخول</button> -->
        <button type="button" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--raised mdl-button--colored u-center">دخول</button>
  </div>
  </dialog>

  <dialog class="mdl-dialog dialog" id="signupDialog">
    <div class="mdl-diaglog__head">
    <div class="mdl-dialog__text">
        <h5>تسجيل حساب جديد</h5>
         <p>سجل حساب جديد فى تطبيق دور</p>
         <p>إذا كنت مسجل مسبقا قم بـ <a href="#" id="reLoginBtn">تسجيل دخول</a></p>
    </div>
    <div class="mdl-dialog__logo">
        <div class="bg"></div>
    <img  src={{ asset('images/dorr-logo.svg') }} alt="Dorr">
    </div>
    </div>
    
    <div class="mdl-dialog__content">
        @include('components.signupForm')
    </div>
    <div class="mdl-dialog__actions mdl-dialog__actions--full-width">
        <!-- <button type="button" class="mdl-button">دخول</button> -->
        <button type="button" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--raised mdl-button--colored u-center">دخول</button>
  </div>
  </dialog>
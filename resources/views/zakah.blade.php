@extends('layouts.app') @section('header') @endsection @section('content')
<div class="content content-padding">
    <div class="group-ad">
        <div class="group-ad__header">
            <h6 class="group-ad__title">الزكاة</h6>
        </div>

            <div class="mdl-card u-padding-top-45 u-padding-bottom-45 mdl-shadow--2dp u-full-width u-mbuttom30 u-center">
                <div class="card-sub--title">
                    يمكنك حساب الزكاةمن خلال إدخال المبلغ المراد حسابه فى حقل المبلغ
                </div>
    
                   
                        <div class="mdl-textfield u-mbuttom16 u-mtop16 mdl-js-textfield u-mdl-textfield--center mdl-textfield--floating-label">
                            <input class="mdl-textfield__input" type="text" id="zakah">
                            <label class="mdl-textfield__label" for="zakah">المبلغ</label>
                        </div>
                    
                   
                   <div class="card-sub--title"> نسبةالزكاة</div>
                   <div class="card-result" id="zakahResult"></div>
                  
                    
                    
                   
                
            </div>
       
    </div>


</div>

@endsection
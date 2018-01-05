<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        // language code
        app()->singleton('lang', function(){
            if(auth()->user()){
                if(empty(auth()->user()->lang)){
                    //session()->put('lang','ar');
                    return 'ar';
                }else{
                    //session()->put('lang',auth()->user()->lang) ;
                    return auth()->user()->lang;
                }
            }else{
                if(session()->has('lang')){
                    return session()->get('lang');
                }else{
                    //session()->put('lang','ar');
                    return 'ar';
                }
            }
        });
        

        // to fix migration error
        Schema::defaultStringLength(250);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

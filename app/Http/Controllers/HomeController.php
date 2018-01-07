<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use App\FilterMenu;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $filterMenus = FilterMenu::all();
        return view('home', ['name'=>'name_'.App::getLocale(), 'filterMenus'=>$filterMenus,]);
    }

    public function lang($lang)
    {
        
        if(in_array($lang,['ar','en'])){
            if(auth()->user()){
                $user = auth()->user();
                $user->lang = $lang;
                $user->save();
            }else{
                if(session()->has('lang')){
                    session()->forget('lang');
                }
                session()->put('lang',$lang);
                
            }
        }else{
            if(auth()->user()){
                $user = auth()->user();
                $user->lang = 'ar';
                $user->save();
            }else{
                if(session()->has('lang')){
                    session()->forget('lang');
                }
                session()->put('lang','ar');
            }
        }
        
        return back();
    }
}

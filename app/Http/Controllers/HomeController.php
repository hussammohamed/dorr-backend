<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use App\FilterMenu;
use App\Property;
use App\Region;

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
        $latestProperties = Property::where('active','=', 1)->where('deleted','=', 0)->orderBy('created_at', 'desc')->limit(4)->get();
        $featuredProperties = Property::where('active','=', 1)->where('deleted','=', 0)->where('featured','=', 1)->limit(4)->get();
        $cities = Region::where('type',1)->where('active',1)->where('deleted',0)->orderby('order')->get();
        return view('home', ['name'=>'name_'.App::getLocale(), 'filterMenus'=>$filterMenus, 'latestProperties'=>$latestProperties, 'featuredProperties'=>$featuredProperties, 'cities'=>$cities ]);
    }

    public function report()
    {
        $filterMenus = FilterMenu::all();
        $latestProperties = Property::where('active','=', 1)->where('deleted','=', 0)->orderBy('created_at', 'desc')->limit(4)->get();
        $featuredProperties = Property::where('active','=', 1)->where('deleted','=', 0)->where('featured','=', 1)->limit(4)->get();
        $cities = Region::where('type',1)->where('active',1)->where('deleted',0)->orderby('order')->get();
        return view('report', ['name'=>'name_'.App::getLocale(), 'filterMenus'=>$filterMenus, 'latestProperties'=>$latestProperties, 'featuredProperties'=>$featuredProperties, 'cities'=>$cities ]);
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

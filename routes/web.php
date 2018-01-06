<?php

use App\Http\Controllers\Response;
use App\Http\Controllers\Auth\RegisterController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('lang/{lang}','HomeController@lang');
Route::group(['middleware'=>'language'],function(){
    Route::get('/', function () {
        return view('home');
    });
    Auth::routes();

    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/property', function () {
        return view('property');
    });
    Route::get('/search', function () {
        return view('searchPage');
    });
    Route::get('/add_ad', function () {
        return view('add_add');
    });
    Route::get('/report', function () {
        return view('report');
    });
    /*Route::get('/myAccount', function () {
        return view('myAccount');
    });*/
    Route::get('/zakah', function () {
        return view('zakah');
    });
    Route::get('/sucsess', function () {
        return view('sucsess');
    });

    Route::get('/myAccount', 'UserController@edit');
    Route::post('/myAccount/update', 'UserController@update');
    Route::post('/myAccount/updatePassword', 'UserController@updatePassword');

    Route::get('Properties/create', 'PropertiesController@create')->name('createProperty');
    Route::get('Properties/store', 'PropertiesController@store');
    Route::get('Properties/show/{id}', 'PropertiesController@show');

    Route::get('/ajax-district/{city}', 'RegionsController@getDistricts');

    


});


//API
Route::get('api/v1/user', 'UserController@getUser');
Route::post('api/v1/users/create', 'Auth\RegisterController@newUser');

Route::post('api/v1/users/createx', function(Illuminate\Http\Request $request){
    return $request->all();
});

Route::post('Properties/search', 'PropertiesController@search');

Route::get('api/v1/regions', 'RegionsController@getDistricts');
Route::get('api/v1/cities', 'RegionsController@getDistricts');
Route::get('api/v1/districts', 'RegionsController@getDistricts');
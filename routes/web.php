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
    //Route::get('/', function () {
    //    return view('home');
    //});
    Auth::routes();

    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/report', 'HomeController@report');
        // Route::get('/property', function () {
        //     return view('property');
        // });
    
        Route::get('/myProperties', function () {
            return view('myProperties');
        });
        Route::get('/search', function () {
            return view('searchPage');
        });
        // Route::get('/add_ad', function () {
        //     return view('add_add');
        // });
        //Route::get('/report', function () {
        //    return view('report');
        //});
        /*Route::get('/myAccount', function () {
            return view('myAccount');
        });*/
        Route::get('/zakah', function () {
            return view('zakah');
        });
        Route::get('/sucsess', function () {
            return view('sucsess');
        });

    Route::get('myAccount', 'UserController@edit');
    Route::get('myAccount/Properties','UserController@getUserProperties');
    Route::post('myAccount/update', 'UserController@update');
    Route::post('myAccount/updatePassword', 'UserController@updatePassword');

    Route::get('properties/create', 'PropertiesController@create')->name('createProperty');
    Route::post('properties/store', 'PropertiesController@store');
    Route::get('properties/show/{id}', 'PropertiesController@show');
    Route::get('properties/edit/{id}', 'PropertiesController@edit');
    Route::post('properties/addImages', 'PropertiesController@addImages');
    Route::post('properties/update', 'PropertiesController@update');
    
    Route::get('ajax-district/{city}', 'RegionsController@getDistricts');

    Route::post('properties/search', 'PropertiesController@porpertySearch')->name('searchProperty');
    
    Route::get('getImages', 'PropertiesController@getImages');
    


});

//API
Route::post('api/v1/users/create', 'Auth\RegisterController@newUser');
Route::post('api/v1/users/login', 'Auth\LoginController@setLogin');
Route::post('api/v1/user/update', 'UserController@updateUser');
Route::post('api/v1/user/update_password', 'UserController@updatePasswordAPI');
Route::get('api/v1/user', 'UserController@getUser');
Route::get('api/v1/properties/searchP', 'PropertiesController@porpertySearchByPoint');
Route::get('api/v1/properties/getFormData', 'PropertiesController@getFormData');
Route::post('api/v1/properties/search', 'PropertiesController@getSearch');
Route::get('api/v1/properties/user', 'PropertiesController@getByLoginedUser');
Route::get('api/v1/properties/user/{user_id}', 'PropertiesController@getByUser');
Route::post('api/v1/property/store', 'PropertiesController@storeAPI');
Route::post('api/v1/property/{id}/update', 'PropertiesController@updateAPI');
Route::get('api/v1/properties/featured', 'PropertiesController@getFeatured');
Route::get('api/v1/properties/latest', 'PropertiesController@getLatest');
Route::get('api/v1/properties/region/{region_id}', 'PropertiesController@getListByRegion');
Route::get('api/v1/property/{id}', 'PropertiesController@getProperty');
Route::get('api/v1/property/images/{id}', 'PropertiesController@getImages');
Route::get('api/v1/property/{id}/add_images', 'PropertyImagesController@storeNew');
Route::get('api/v1/property/similer/{id}', 'PropertiesController@getSimilerProperties');
Route::get('api/v1/property/offers/{id}', 'PropertyOfferController@getPropertyOffers');
Route::post('api/v1/property/offers/{id}/store', 'PropertyOfferController@storeAPI');
Route::get('api/v1/properties', 'PropertiesController@getList');
Route::get('api/v1/regions/districts', 'RegionsController@getDistricts');
Route::get('api/v1/regions/{city}', 'RegionsController@getDistrictsByCity');
Route::get('api/v1/regions/{lat}/{long}', 'RegionsController@getDistrictsByPoint');
Route::get('api/v1/regions', 'RegionsController@getCities');
Route::get('api/v1/filters', 'FilterMenuController@getFilterMenus');
Route::get('api/v1/types', 'TypesController@getTypes');
Route::get('api/v1/purposes', 'PurposesController@getPurposes');


/*
Route::group(['middleware'=>'auth:api'], function(){
	Route::get('test', function(){
        return "hi";
    });
});
*/
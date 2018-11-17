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
        Route::get('/reset-sucsess', function () {
            return view('sucsessReset');
        });
        Route::get('/logout-session', function () {
            return view('logout-session');
        });
    Route::get('myAccount', 'UserController@edit');
    Route::get('myAccount/Properties','UserController@getUserProperties');
    Route::post('myAccount/update', 'UserController@update_old');
    Route::post('myAccount/updatePassword', 'UserController@updatePassword');
    Route::post('myAccount/updateAgency', 'AgencyController@oldUpdate');
    Route::post('myAccount/createAgency', 'AgencyController@oldStore');

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
Route::post('api/v1/user/reset_link','Auth\ForgotPasswordController@sendResetLink');
Route::post('api/v1/user/avatar/upload', 'UserController@uploadAvatar');
Route::get('api/v1/user/avatar', 'UserController@getAvatar');
Route::get('api/v1/user/avatar/{id}', 'UserController@getAvatarByUserID');
Route::get('api/v1/user', 'UserController@getUser');
Route::get('api/v1/properties/searchP', 'PropertiesController@porpertySearchByPoint');
Route::get('api/v1/properties/getFormData', 'FormController@getFormData');
Route::get('api/v1/forms/getFormData', 'FormController@getFormData');
Route::post('api/v1/properties/search', 'PropertiesController@getSearch');
Route::get('api/v1/properties/user', 'PropertiesController@getByLoginedUser');
Route::get('api/v1/properties/user/{user_id}', 'PropertiesController@getByUser');
Route::post('api/v1/property/store', 'PropertiesController@storeAPI');
Route::post('api/v1/property/{id}/update', 'PropertiesController@updateAPI');
Route::put('api/v1/property/{id}/delete', 'PropertiesController@delete');
Route::delete('api/v1/property/{id}/destroy', 'PropertiesController@destroy');
Route::get('api/v1/properties/featured', 'PropertiesController@getFeatured');
Route::post('api/v1/properties/{id}/featured', 'PropertiesController@setFeatured');
Route::get('api/v1/properties/latest', 'PropertiesController@getLatest');
Route::get('api/v1/properties/region/{region_id}', 'PropertiesController@getListByRegion');
Route::get('api/v1/property/{id}', 'PropertiesController@getProperty');
Route::get('api/v1/property/images/{id}', 'PropertiesController@getImages');
Route::put('api/v1/property/images/{id}/delete', 'PropertyImagesController@delete');
Route::delete('api/v1/property/images/{id}/destroy', 'PropertyImagesController@destroy');
Route::get('api/v1/property/{id}/add_images', 'PropertyImagesController@storeNew');
Route::get('api/v1/property/similer/{id}', 'PropertiesController@getSimilerProperties');
Route::get('api/v1/property/offers/{id}', 'PropertyOfferController@getPropertyOffers');
Route::post('api/v1/property/offers/{id}/store', 'PropertyOfferController@storeAPI');
Route::put('api/v1/property/offers/{id}/delete', 'PropertyOfferController@delete');
Route::delete('api/v1/property/offers/{id}/destroy', 'PropertyOfferController@destroy');
Route::get('api/v1/property/reports/{id}', 'PropertyReportController@getByProperty');
Route::post('api/v1/property/reports/{id}/store', 'PropertyReportController@storeAPI');
Route::get('api/v1/properties', 'PropertiesController@getList');
Route::get('api/v1/regions/districts', 'RegionsController@getDistricts');
Route::get('api/v1/regions/{city}', 'RegionsController@getDistrictsByCity');
Route::get('api/v1/regions/{lat}/{long}', 'RegionsController@getDistrictsByPoint');
Route::get('api/v1/regions', 'RegionsController@getCities');
Route::get('api/v1/filters', 'FilterMenuController@getFilterMenus');
Route::get('api/v1/types', 'TypesController@getTypes');
Route::get('api/v1/purposes', 'PurposesController@getPurposes');


Route::post('api/v1/val', 'PropertiesController@val');
Route::post('api/v1/test/{id}', 'PropertiesController@test');

/*
Route::group(['middleware'=>'auth:api'], function(){
	Route::get('test', function(){
        return "hi";
    });
});
*/

Route::group(['prefix'=>'api/v1'],function(){

	Route::apiResource('/users','UserController');
    //Route::post('/users/{id}/delete', 'UserController@delete');
    Route::post('/users/search', 'UserController@searchForUser'); 
    Route::post('/users/{id}', 'UserController@update'); 
    

	Route::apiResource('/banks','BankController');
    Route::post('/banks/delete', 'BankController@delete');

	Route::apiResource('/id_types','IdTypeController');
    Route::post('/id_types/delete', 'IdTypeController@delete');

    Route::apiResource('/nationalities','NationalityController');
    Route::post('/nationalities/delete', 'NationalityController@delete');

    Route::apiResource('/agencies','AgencyController');
    Route::post('/agencies/{id}', 'AgencyController@update'); 
    
    Route::apiResource('/mproperties','MPropertyController');
    Route::post('/mproperties/{id}/owner','MPropertyController@addOnwer');
    Route::post('/mproperties/{id}', 'MPropertyController@update');
    
	Route::get('/units/contract','ContractUnitController@contractX');
	Route::apiResource('/units','UnitController');
    Route::post('/units/delete', 'UnitController@delete');
    Route::get('/mproperties/{id}/units', 'UnitController@indexByMProperty');
    
    Route::get('/contracts/notify', 'ContractController@notifyx');
	Route::apiResource('/contracts','ContractController');
    Route::post('/contracts/{id}', 'ContractController@update');
    Route::post('/contracts/{id}/status/{status}', 'ContractController@changeStatus');
    Route::post('/contracts/delete', 'ContractController@delete');
    Route::get('/mproperties/{id}/contracts', 'ContractController@indexByMProperty');

    
	Route::apiResource('/maintenances','MaintenanceController');
    Route::post('/maintenances/{id}', 'MaintenanceController@update');
    Route::post('/maintenances/{id}/close', 'MaintenanceController@close');
    Route::post('/maintenances/{id}/status/{status}', 'MaintenanceController@changeStatus');
    Route::get('/mproperties/{id}/maintenances', 'MaintenanceController@indexByMProperty');

    
	Route::apiResource('/payments','PaymentController');
    Route::post('/payments/{id}', 'PaymentController@update');
    Route::post('/payments/{id}/status/{status}', 'PaymentController@changeStatus');
    Route::post('/payments/{id}/collected', 'PaymentController@collected');
    Route::get('/mproperties/{id}/payments', 'PaymentController@indexByMProperty');

    
	Route::apiResource('/payment_orders','PaymentOrderController');
    Route::post('/payment_orders/{id}', 'PaymentOrderController@update');
    Route::post('/payment_orders/{id}/collected/{remaining}', 'PaymentOrderController@collected');
    Route::post('/payment_orders/{id}/status/{status}', 'PaymentOrderController@changeStatus');
    Route::get('/mproperties/{id}/payment_orders', 'PaymentOrderController@indexByMProperty');

    
	Route::apiResource('/payment_collects','PaymentCollectController');
    Route::post('/payment_collects/{id}', 'PaymentCollectController@update');
    Route::post('/payment_collects/{id}/status/{status}', 'PaymentCollectController@changeStatus');
    Route::get('/payment_orders/{id}/payment_collects', 'PaymentCollectController@indexByPaymentOrder');

    Route::apiResource('/transactions','TransactionController');
    Route::post('/transactions/{id}', 'TransactionController@update');
    Route::get('/mproperties/{id}/transactions/filter/{filter}', 'TransactionController@filter');
    Route::get('/mproperties/{id}/transactions', 'TransactionController@indexByMProperty');
    Route::get('/mproperties/{id}/transactions_total', 'TransactionController@total');
    
    Route::apiResource('/transfer_requests','TransferRequestController');
    Route::post('/transfer_requests/{id}', 'TransferRequestController@update');
    Route::get('/mproperties/{id}/transfer_requests', 'TransferRequestController@indexByMProperty');
    Route::post('/transfer_requests/{id}/status/{status}', 'TransferRequestController@changeStatus');


    /*
    Route::apiResource('/types','TypesController');
    Route::post('/types/{id}/delete', 'TypesController@delete');

	Route::apiResource('/advertisers','AdvertiserController');
    Route::post('/advertisers/{id}/delete', 'AdvertiserController@delete');

	Route::apiResource('/filter_menus','FilterMenuController');
    Route::post('/filter_menus/{id}/delete', 'FilterMenuController@delete');

	Route::apiResource('/finish_types','FinishTypesController');
    Route::post('/bafinish_typesnks/{id}/delete', 'FinishTypesController@delete');

	Route::apiResource('/map_views','MapViewController');
    Route::post('/map_views/{id}/delete', 'MapViewController@delete');

	Route::apiResource('/pages','PageController');
    Route::post('/pages/{id}/delete', 'PageController@delete');

	Route::apiResource('/payment_methods','PaymentMethodsController');
    Route::post('/payment_methods/{id}/delete', 'PaymentMethodsController@delete');

	Route::apiResource('/periods','PeriodController');
    Route::post('/periods/{id}/delete', 'PeriodController@delete');

	Route::apiResource('/purposes','PurposesController');
    Route::post('/purposes/{id}/delete', 'PurposesController@delete');

	Route::apiResource('/region_types','RegionsTypesController');
    Route::post('/region_types/{id}/delete', 'RegionsTypesController@delete');

	Route::apiResource('/regions','RegionsController');
    Route::post('/banregionsks/{id}/delete', 'RegionsController@delete');

	Route::apiResource('/reporting_reasons','ReportingReasonsController');
    Route::post('/reporting_reasons/{id}/delete', 'ReportingReasonsController@delete');

	Route::apiResource('/social_media','SocialMediaController');
    Route::post('/social_media/{id}/delete', 'SocialMediaController@delete');
*/
});



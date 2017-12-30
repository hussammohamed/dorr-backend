<?php

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
Route::get('/myAccount', function () {
    return view('myAccount');
});
Route::get('/zakah', function () {
    return view('zakah');
});
Route::get('/sucsess', function () {
    return view('sucsess');
});



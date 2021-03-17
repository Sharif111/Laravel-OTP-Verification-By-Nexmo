<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});
Route::get('/master', function () {
    return view('backend.master');
});
Route::get('/facilities','FacilitiesController@index')->name('facilities');
Route::post('/facilities/create','FacilitiesController@create')->name('facilities.create');


Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/verify','VerifyController@getVerify')->name('getVerify');
Route::post('/verify','VerifyController@postVerify')->name('verify');


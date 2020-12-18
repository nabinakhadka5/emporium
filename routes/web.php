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

Route::group(['middleware' => ['auth','user'], 'namespace' => "Front", 'as' => 'front.'], function () {
    require base_path('routes/frontend.php');
});



Route::group(['prefix'=>'admin','middleware'=>['auth','user']],function(){

    Route::get('/','HomeController@user')->name('user');
    Route::post('/get-child', 'CategoryController@getAllChild')->name('get-child');
    Route::resource('slider', 'SliderController');
    Route::resource('category', 'CategoryController');
    Route::resource('product', 'ProductController');
    Route::resource('page', 'PageController');
});

Auth::routes(['register'=>false]);

Route::get('/home', 'HomeController@index')->name('home');

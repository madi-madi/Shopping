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

Route::get('/upload','FtpController@index');
Route::post('/upload','FtpController@store');

/*Route::get('/', function () {
    return view('welcome');
});*/
Route::get('/' ,'ProductController@index');

Route::get('mailInfo', 'ProductController@mailInfo');
Route::get('testmail', 'ProductController@testMail');

Auth::routes();

Route::group(['middleware' => ['web','auth']], function () {
	
	
	//Route::post('add/cart/{id}', 'InvoiceController@store');
    Route::get('payPremium', ['as'=>'payPremium','uses'=>'ProductController@payPremium']);
    Route::get('shopping-cart-all', 'ProductController@show');
    Route::post('getCheckout', ['as'=>'getCheckout','uses'=>'ProductController@getCheckout_Paypal']);
    Route::post('/checkout','ProductController@getCheckout_Stripe');
    Route::get('getDone', ['as'=>'getDone','uses'=>'ProductController@getDone']);
    Route::get('getCancel', ['as'=>'getCancel','uses'=>'ProductController@getCancel']);
    // Cart
    Route::get('shop/{id}', 'ShopController@index');
	Route::get('/homepage','ProductController@index');



	Route::get('/shopping-cart-all','ProductController@showCart');
});

//Route::post('/shopping-cart-all','ProductController@payment');
Route::get('/invoice/{id}/download','ProductController@download')->middleware('invoice');
Route::post('/invoice/{invoice_id}/{product_id}/download','ProductController@downloadDone');
//Route::get('/invoice/{invoice_id}/{product_id}/download','ProductController@getDownload');
Route::post('/invoice/{invoice_id}/download-all' , 'ProductController@downloadAll');



//getCookie
    Route::get('/add-cart','ProductController@addCart');
    Route::get('get/cookiees','ProductController@getCookie');
    Route::get('/remove-cart','ProductController@removeCart');


Route::get('/home', 'HomeController@index')->name('home');

Route::get('/auth/facebook' , 'Auth\RegisterController@redirectToProvider');
Route::get('/callback' , 'Auth\RegisterController@handleProviderCallback');

Route::get('/auth/twitter' , 'Auth\RegisterController@redirectToTwitter');
Route::get('/callback' , 'Auth\RegisterController@handleTwitterCallback');



Route::get('/cookie/set','CookieController@setCookie');
Route::get('/cookie/get','CookieController@getCookie');
Route::get('/cookies','CookieController@cookies');
Route::get('/cookies-index','CookieController@index');
Route::get('/cookies-index','CookieController@cokie');
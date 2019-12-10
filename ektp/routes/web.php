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
Route::get('/','Website\Home\HomeController@index')->name('landing.index');
Route::get('/howto','Website\Home\HomeController@tatacara')->name('landing.tatacara');
Route::get('/about','Website\Home\HomeController@about')->name('landing.about');
Route::get('/register','Website\Home\HomeController@daftar')->name('landing.daftar');
Route::get('qrcode',function(){
	\QrCode::size(500)
            ->format('png')
            ->generate('notfound', public_path('images/qrcode.png'));
    
	return view('website.qrcode.qrcode');
});
Route::post('/store','Website\Home\HomeController@store')->name('home.storing');
Route::get('/cities/{id}','Website\Home\HomeController@getCities')->name('home.cities');
Route::get('/districts/{id}','Website\Home\HomeController@getDistricts')->name('home.districts');
Route::get('/subdistricts/{id}','Website\Home\HomeController@getSubDistricts')->name('home.subdistricts');
Route::get('/home','Pendaftaran\Home\HomeController@index')->name('pendaftaran.index');
Route::get('/login','Pendaftaran\Auth\LoginController@index')->name('login.index');
Route::post('/login','Pendaftaran\Auth\LoginController@store')->name('login.store');
Route::resource('pengguna','Pengguna\PenggunaController');

//Route::get('/tap/{id}', 'Tap\Tap\TappingController@tapCard')->name('tap.process');

Route::get('/tap/multi/{id}/{uid}', 'Tap\Tap\TappingController@tapCardMulti')->name('tap.multi');
Route::post('/tap', 'Tap\Tap\TappingController@tapCardPost')->name('tap.post');
Route::get('/transaksi/{alat_id}', 'Website\Transaksi\TransaksiController@show')->name('transaksi.show');
Route::get('/tiket/', 'Website\Tiket\TiketController@index')->name('tiket.index');
Route::get('/tiket/{id}/{kelas}', 'Website\Tiket\TiketController@edit')->name('tiket.edit');
Route::post('/tiket/list', 'Website\Tiket\TiketController@listTiket')->name('tiket.list');
Route::post('/tiket/update', 'Website\Tiket\TiketController@update')->name('tiket.update');
Route::get('tap/test', 'Tap\Tap\TappingController@testurl');
Route::get('/penjualan/nohp/{alat_id}', 'Website\Transaksi\TransaksiController@show');
Route::get('log/index', 'Logs\Logs\LogsController@index')->name('logs.index');
Route::get('log/payment', 'Logs\Logs\LogsController@paymentindex')->name('logs.paymentindex');
Route::get('log/ticket', 'Logs\Logs\LogsController@ticket')->name('logs.ticket');
Route::get('log/presence', 'Logs\Logs\LogsController@presence')->name('logs.presence');
Route::get('log/bpjs', 'Logs\Logs\LogsController@bpjs')->name('logs.bpjs');
Route::get('log/parking', 'Logs\Logs\LogsController@parking')->name('logs.parking');
Route::post('log/find', 'Logs\Logs\LogsController@find')->name('logs.find');
Route::get('log/search', 'Logs\Logs\LogsController@search')->name('logs.search');
Route::get('log/show/{id}', 'Logs\Logs\LogsController@show')->name('logs.show');
Route::get('log/block/{id}', 'Logs\Logs\LogsController@block')->name('logs.block');
Route::get('log/unblock/{id}', 'Logs\Logs\LogsController@unblock')->name('logs.unblock');
Route::get('log/payment/merchant', 'Logs\Logs\LogsController@merchant')->name('logs.merchant');
Route::get('log/payment/all', 'Logs\Logs\LogsController@paymentall')->name('logs.paymentall');
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
    return redirect('login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('confirm', 'ConfirmController@index');
Route::post('confirm', 'ConfirmController@approve');
Route::post('remove', 'ConfirmController@remove');


Route::resource('location', 'LocationController');
Route::resource('pelatih', 'PelatihController');
Route::resource('santri', 'SantriController');
Route::resource('group', 'GroupController');
Route::post('group/leader/{id}', 'GroupController@changeLeader');

Route::get('print/group','GroupController@print');

Route::post('santri/{id}/chgroup', 'SantriController@chgroup');
Route::get('group/jadwal/{id}', 'JadwalController@index')->name('group-jadwal');
Route::resource('jadwal', 'JadwalController');

Route::get('dashboard', 'DashboardController@index');
Route::get('home/pelatih', 'PelatihUserController@index');
Route::get('home/santri', 'SantriUserController@index');
Route::get('home/pelatih/jadwal', 'PelatihUserController@showJadwal');
Route::get('home/pelatih/jadwal/{id}', 'PelatihUserController@showDetail');

Route::post('message/broadcast/{id}', 'MessageController@sendBroadcast');
Route::post('message/cancel/{id}', 'MessageController@sendCancelation');
Route::get('message/{id}', 'MessageController@getMessage');

Route::post('users/password/{id}', 'HomeController@changePassword');
Route::post('santri/lvlup/{id}', "SantriController@lvlup");
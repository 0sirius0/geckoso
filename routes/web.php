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
    return view('welcome');
});

Route::get('/login', 'MainController@login');
Route::get('/bookkind', 'MainController@bookkind');
Route::get('/book', 'MainController@book');
Route::get('/rental', 'MainController@rental');


Route::get('/login/successlogin', 'MainController@successlogin');
Route::post('/checklogin', 'MainController@checkLogin');
Route::get('/logout', 'MainController@logout');

Route::post('/bookkind/add', 'MainController@addkind');
Route::get('/bookkind/success', 'MainController@kindsuccess');

Route::post('/book/add', 'MainController@addbook');
Route::get('/book/success', 'MainController@booksuccess');

Route::get('/rental', 'MainController@rental');
Route::post('maincontroller/fetch', 'MainController@fetch')->name('maincontroller.fetch');
Route::post('/rental/add', 'MainController@addrental');

Route::get('/history', 'MainController@history');
Route::post('/history/student', 'MainController@historybystudent');
Route::post('maincontroller/updaterental', 'MainController@updaterental')->name('maincontroller.updaterental');

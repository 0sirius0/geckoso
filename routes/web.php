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
Route::group(['middleware' => 'auth'], function () {

    Route::get('/', function(){
        return view('home');
    });

    Route::post('/level/add', 'userlevelController@addLevel');
    Route::get('/level/list', 'userlevelController@getAllLevel');
    Route::get('/level/up', 'userlevelController@movelevelup');
    Route::get('/level/down', 'userlevelController@moveleveldown');
    
    Route::get('/logout', 'userController@logout');
    Route::get('/employee/register', 'userController@register');
    Route::get('/employee/profile', 'userController@getUserById');
    Route::get('/employee/list', 'userController@getUserList');
    Route::get('/employee/delete', 'userController@deleteUser');
    Route::post('/employee/update', 'userController@updateUser');
    Route::post('/employee/add', 'userController@addUser');

    Route::post('/class/add', 'classController@addClass');
    Route::get('/class/list', 'classController@getAllClass');
    Route::get('/class/update', 'classController@updateClass');
    Route::get('/class/autocomplete', 'classController@autocompleteClass');

    Route::get('/student/list', 'studentController@getStudentList');
    Route::post('/student/add', 'studentController@addStudent');
    Route::get('/student/autocomplete', 'studentController@autocompleteStudent');

    Route::get('/kind/list', 'kindController@getKindList');
    Route::get('/kind/delete', 'kindController@deleteKind');
    Route::post('/kind/add', 'kindController@addKind');
    Route::get('/kind/autocomplete', 'kindController@autocompleteKind');
    
    Route::get('/book/list', 'bookController@getBookList');
    Route::get('/book/info', 'bookController@getABook');
    Route::get('/book/listbykind', 'bookController@getBookListByKind');
    Route::post('/book/add', 'bookController@addBook');
    Route::post('/book/update', 'bookController@updateBook');
    Route::get('/book/delete', 'bookController@deleteBook');
    Route::get('/book/autocomplete', 'bookController@autocompleteBook');

    Route::get('/rental/create', 'rentalController@createRental');
    Route::get('/rental/history', 'rentalController@getRentalAll');
    Route::get('/rental/historydisasble', 'rentalController@getRentalDisable');
    Route::get('/rental/checkrecieve', 'rentalController@updateRental');
    Route::get('/rental/search', 'rentalController@getRentalByStudentName');
    Route::get('/rental/searchbystuid', 'rentalController@getRentalByStudentId');
    Route::post('/rental/add', 'rentalController@addRental');
});

Route::get('/login', 'userController@login')->name('login');
Route::post('/checklogin', 'userController@checkLogin');

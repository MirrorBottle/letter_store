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

Auth::routes();

Route::redirect('/home', '/');
Route::redirect('/', '/login');
Route::group(['middleware' => 'auth'], function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::resource('user', 'UserController', ['except' => ['show']]);
    Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
    Route::get('/mails/{slug}', ['as' => 'mails.index', 'uses' => 'MailsController@index']);
    Route::get('/mails/create', 'MailsController@create');
    Route::get('/mails/edit/{id}', 'MailsController@edit');
    Route::get('/mails/destroy/{id}', ['as' => 'mails.destroy', 'uses' => 'MailsController@destroy']);
    Route::put('/mails/{id}', 'MailsController@update');
    Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
    Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
    Route::put('mails', ['as' => 'mails.update', 'uses' => 'MailsController@update']);
    Route::post('/mails/store', 'MailsController@store');
    Route::post('/mails/update', 'MailsController@update');
    Route::resource('log', 'LogsController');
});

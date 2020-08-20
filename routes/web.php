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

Route::get('/', 'DisastersController@index'); 

// ユーザ登録
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');

// ログイン認証
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');

// ユーザ機能（認証okのみをルートする）
Route::group(['middleware' => 'auth'], function () {
    
    //安否確認
    Route::get('safeties/editByUser/{id}', 'SafetiesController@editByUser')->name('safety.editByUser');
    Route::put('safeties/{id}', 'SafetiesController@update')->name('safety.update');
    Route::get('safeties/indexByDisaster/{id}', 'SafetiesController@indexByDisaster')->name('safety.indexByDisaster');
    Route::delete('safeties/{id}', 'SafetiesController@destroy')->name('safety.destroy');

    //災害一覧
    Route::resource('disasters', 'DisastersController', ['only' => ['index', 'create', 'store', 'edit', 'update', 'destroy']]);

    //ユーザ更新
    Route::resource('users', 'UsersController', ['only' => ['index', 'edit', 'update', 'destroy']]);

});

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

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() {
    Route::get('news/create', 'Admin\NewsController@add')->middleware('auth'); //getメソッド Admin\NewsControllerのadd Actionに渡す
    Route::post('news/create', 'Admin\NewsController@create'); //postメソッド　Admin\NewsControllerのcreate Actionに渡す
    
    Route::get('profile/create','Admin\ProfileController@add')->middleware('auth'); //getメソッド　Admin\ProfileControllerのadd Actionに渡す
    Route::post('profile/create','Admin\ProfileController@create'); //postメソッド　Admin\ProfileControllerのcreate Actionに渡す
    
    Route::get('profile/edit','Admin\ProfileController@edit')->middleware('auth'); //getメソッド　Admin\ProfileControllerのedit Actionに渡す
    Route::post('profile/edit', 'Admin\ProfileController@update'); //postメソッド　Admin\ProfileControllerのupdate Actionに渡す
});

/*09-3. 「http://XXXXXX.jp/XXX というアクセスが来たときに、 AAAControllerのbbbというAction に渡すRoutingの設定」を書いてみてください*/

Route::get('XXX','AAAController@bbb');

/*09-4. 【応用】 前章でAdmin/ProfileControllerを作成し、add Action, edit Actionを追加しました。
web.phpを編集して、admin/profile/create にアクセスしたら ProfileController の add Action に、
admin/profile/edit にアクセスしたら ProfileController の edit Action に割り当てるように設定してください*/

//→22、25行目

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

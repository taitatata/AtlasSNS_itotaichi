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

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();


//ログイン
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login')->middleware('guest');
Route::post('/login', 'Auth\LoginController@login');

//新規登録
Route::post('/register', 'Auth\RegisterController@register');

//ログアウト
Route::get('/logout', 'Auth\LoginController@logout')->name('logout'); //追記

//登録完了ページ
Route::get('/added', 'Auth\RegisterController@added')->middleware('guest');
Route::post('/added', 'Auth\RegisterController@added');

//伊藤：アクセス制限機能実装のため追記
Route::middleware(['auth'])->group(function () {
    Route::get('/top', 'PostsController@index')->name('top');
    Route::get('/profile', 'UsersController@profile')->name('profile');
    Route::get('/search', 'UsersController@search')->name('search');
    Route::get('/follow-list', 'PostsController@followList')->name('follow-list');
    Route::get('/follower-list', 'PostsController@followerList')->name('follower-list');
});

//ログイン中のページ
// Route::get('/top','PostsController@index');

// Route::get('/profile','UsersController@profile');

// Route::get('/search','UsersController@index');

// Route::get('/follow-list','PostsController@index');

// Route::get('/follower-list','PostsController@index');

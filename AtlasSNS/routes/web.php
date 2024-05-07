<?php

//投稿登録機能
use App\Http\Controllers\PostsController;


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

//ユーザーの新規登録完了ページ
Route::get('/added', 'Auth\RegisterController@added')->middleware('guest');
Route::post('/added', 'Auth\RegisterController@added');

//アクセス制限機能実装のため追記
Route::middleware(['auth'])->group(function () {
    Route::get('/top', 'PostsController@index')->name('top');
    Route::get('/profile/{id}', 'UsersController@profile')->name('user.profile');
    Route::get('/search', 'UsersController@search')->name('user.search');
    Route::get('/follow-list', 'FollowsController@followList')->name('follow-list');
    Route::get('/follower-list', 'FollowsController@followerList')->name('follower-list');
});

//投稿
Route::post('/posts', [PostsController::class, 'store'])->name('posts.store');

//投稿一覧の表示
Route::get('/posts', [PostsController::class, 'index'])->name('posts.index');

//編集フォームの表示と更新
Route::get('/posts/{post}/edit', 'PostsController@edit')->name('posts.edit');
Route::put('/posts/{post}', 'PostsController@update')->name('posts.update');

//削除機能の実装
Route::delete('/posts/{post}', 'PostsController@destroy')->name('posts.destroy');

// 検索ページ：フォロー・フォロー解除
Route::post('/follow/{user}', 'FollowsController@follow')->name('follow');
Route::delete('/unfollow/{user}', 'FollowsController@unfollow')->name('unfollow');

// ログインユーザーのプロフィール編集
Route::put('/profile/{id}', 'UsersController@update')->name('user.update');

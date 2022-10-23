<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();


// フォロー/フォロー解除を追加
Route::post('/profile/{user}/follow', 'App\Http\Controllers\ProfilesController@follow')->name('follow');
Route::delete('/profile/{user}/unfollow', 'App\Http\Controllers\ProfilesController@unfollow')->name('unfollow');

//タイムライン
Route::get('timeline','App\Http\Controllers\PostsController@index')->name('timeline');

// ユーザ関連
Route::resource('users', 'App\Http\Controllers\UsersController', ['only' => ['index', 'show', 'edit', 'update']]);

Route::get('/p/create','App\Http\Controllers\PostsController@create');
Route::get('/p/{post}','App\Http\Controllers\PostsController@show');
Route::post('/p','App\Http\Controllers\PostsController@store');
Route::delete('/p/{post}', [App\Http\Controllers\PostsController::class, 'destroy'])->name('post.destroy');

Route::get('/profile/{user}', 'App\Http\Controllers\ProfilesController@index')->name('profile.show');
Route::get('/profile/{user}/edit', 'App\Http\Controllers\ProfilesController@edit')->name('profile.edit');
Route::patch('/profile/{user}', 'App\Http\Controllers\ProfilesController@update')->name('profile.update');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::post('/like/{postId}',[App\Http\Controllers\LikeController::class,'store']);
Route::post('/unlike/{postId}',[App\Http\Controllers\LikeController::class,'destroy']);

// ユーザ退会
Route::delete('delete/{user}', [App\Http\Controllers\UsersController::class, 'delete'])->name('user.delete');
Route::get('delete/{user}', 'App\Http\Controllers\UsersController@shows');


// システム管理者のみ
Route::group(['middleware' => ['auth', 'can:system-only']], function () {
 // ユーザ削除
 Route::delete('account/delete/{user}', [App\Http\Controllers\UsersController::class, 'destroy'])->name('user.destroy');
 Route::get('/account/delete/{user}', 'App\Http\Controllers\UsersController@show');
});

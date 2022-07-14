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

//ログイン・ユーザー登録
Auth::routes();

//トップページ
Route::get('/', 'ItemController@index')->name('top');

//---------------------プロフィール------------------------
//詳細
Route::resource('users', 'UserController')->only([
    'show',
]);
//編集
Route::get('/profile/{user}/edit', 'UserController@edit')->name('profile.edit');
Route::patch('/profile/{user}', 'UserController@update')->name('profile.update');
//画像編集
Route::get('/profile/{user}/edit_image', 'UserController@editImage')->name('profile.edit_image');
Route::patch('/profile', 'UserController@updateImage')->name('profile.update_image');


//----------------------出品--------------------------------
//出品商品一覧
Route::get('/users/{user}/exhibitions', 'UserController@index')->name('users.exhibitions');
//出品処理
Route::resource('items', 'ItemController')->only([
    'create', 'store', 'show', 'edit', 'update', 'destroy'
]);
//商品画像編集
Route::get('/items/{item}/edit_image', 'ItemController@editImage')->name('items.edit_image');
Route::patch('/items', 'ItemController@updateImage')->name('items.update_image');

//---------------------購入---------------------------------
//購入確認
Route::get('/items/{item}/confirm', 'ItemController@confirm')->name('items.confirm');
Route::post('/items/confirm', 'ItemController@storeOrder')->name('items.store_order');
//購入確定
Route::get('items/{item}/finish', 'ItemController@finish')->name('items.finish');



//---------------------お気に入り----------------------------
//一覧
Route::resource('likes', 'LikeController')->only([
    'index', 'store', 'destroy',
]);
//いいね処理
Route::patch('/items/{item}/toggle_like', 'LikeController@toggleLike')->name('items.toggle_like');


//--------------------株価チャート------------------
Route::get('/stockchart', function(){
    return view('stockchart');
});

//-------------------ビンゴ-------------------
Route::get('/bingo', function(){
    return view('bingo');
});

//------------------九九---------------
Route::get('/multiplicationtable', function(){
    return view('calculation');
});

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'postagens', 'middleware' => 'auth'], function() {
    Route::get('/', 'Post\PostController@index')->name('postagens');
    Route::get('get-posts', 'Post\PostController@getPosts')->name('get-posts');
    Route::post('create-post', 'Post\PostController@store')->name('create-post');
    Route::delete('delete-post/{id}', 'Post\PostController@destroy')->name('delete-post');
    Route::post('like-post/{id}', 'Post\PostController@likePost')->name('like-post');
    Route::post('dislike-post/{id}', 'Post\PostController@dislikePost')->name('dislike-post');
});

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

Route::get('/', 'HomeController@index')->name('home');
Route::get('/categories/{category}', 'PostController@index')->name('posts.index');
Route::get('posts/show/{post}', 'PostController@show')->name('posts.show');
Route::get('/posts/create', 'PostController@create')->name('create.form')->middleware(['auth','admin']);
Route::post('/posts/create', 'PostController@store')->name('posts.create');
Route::get('/new/category', 'PostController@categForm')->name('category.form')->middleware(['auth','admin']);
Route::post('/create/category', 'PostController@AddCategory')->name('add.category');
Route::post('/comment/{post}', 'PostController@createComment')->name('comment.create');
Route::delete('comment/{comment}/delete', 'PostController@commentDelete')->name('comment.delete');
Route::get('/comment/{comment}/{post}/edit', 'PostController@editComment')->name('comment.edit');
Route::put('/comment/{post}/{comment}', 'PostController@updateComment')->name('comment.update');
Route::delete('/post/{post}/delete', 'PostController@destroy')->name('post.delete');
Route::get('/post/{post}/edit', 'PostController@edit')->name('post.edit');
Route::put('/post/{post}/update', 'PostController@update')->name('post.update');

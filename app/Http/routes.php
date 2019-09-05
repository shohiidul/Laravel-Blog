<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/', array( 'as'=>'guest.home', 'uses'=>'PostViewController@home' ));
Route::get('/details/{name}', array( 'as'=>'guest.post.details', 'uses'=>'PostViewController@details' ));

Route::get('/author/post/{author_id}', array( 'as'=>'guest.post.author', 'uses'=>'PostViewController@author_post' ));
Route::get('/category/post/{category}', array( 'as'=>'guest.post.category', 'uses'=>'PostViewController@category_post' ));
Route::get('/tags/post/{tag}', array( 'as'=>'guest.post.tags', 'uses'=>'PostViewController@tags_post' ));

Route::auth();

Route::get('/home', 'HomeController@index');

Route::group(['middleware' => 'auth'], function () {

    Route::get('/admin/posts', array( 'as'=>'admin.posts', 'uses'=>'PostsController@index' ));
    Route::get('/admin/posts/create', array( 'as'=>'admin.posts.create', 'uses'=>'PostsController@create' ));
    Route::any('/admin/posts/store', array( 'as'=>'admin.posts.store', 'uses'=>'PostsController@store' ));
    Route::get('/admin/posts/edit/{id}', array( 'as'=>'admin.posts.edit', 'uses'=>'PostsController@edit' ));
    Route::any('/admin/posts/update/{id}', array( 'as'=>'admin.posts.update', 'uses'=>'PostsController@update' ));

    Route::resource('category','CategoryController');
    Route::resource('tag','TagController');
    Route::resource('bookmark','BookmarkController');
    
});

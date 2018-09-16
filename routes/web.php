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

Route::get('/', 'HomeController@index')->name('home');
Route::get('posts/{slug}', 'PostController@details')->name('post.details');
Route::get('allpost', 'PostController@allpost')->name('all.post');
Route::get('category/{slug}', 'PostController@postByCategory')->name('category.post');
Route::get('tag/{slug}', 'PostController@postByTag')->name('tag.post');

Route::get('profile/{username}', 'AuthorController@profile')->name('author.profile');

Route::post('subscriber', 'SubscriberController@store')->name('subscriber.store');

Route::get('search', 'SearchController@search')->name('search');

Auth::routes();

Route::group(['middleware' => ['auth']], function (){
    Route::post('favorite/{post}/add', 'FavoriteController@add')->name('post.favorite');
    Route::post('comment/{post}', 'CommentController@comment')->name('post.comment');
});

Route::group(['as' => 'admin.','prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth','admin']], function
(){
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');

    Route::get('settings', 'UserSettingsController@index')->name('settings');
    Route::put('profile-update', 'UserSettingsController@updateProfile')->name('profile.update');
    Route::put('password-change', 'UserSettingsController@changePassword')->name('password.change');

    Route::get('favorite-post', 'FavoriteController@favoritePost')->name('favorite.post');

    Route::get('authors', 'AuthorController@index')->name('author.index');
    Route::delete('authors/{id}', 'AuthorController@destroy')->name('author.destroy');

    Route::get('comment', 'CommentController@index')->name('comment.index');
    Route::delete('comment/{id}', 'CommentController@destroy')->name('comment.destroy');

    Route::resource('tag', 'TagController');
    Route::resource('category', 'CategoryController');
    Route::resource('post', 'PostController');

    Route::get('pending/post', 'PostController@pending')->name('post.pending');
    Route::put('/post/{id}/approve', 'PostController@approval')->name('post.approve');

    Route::get('subscriber', 'SubscriberController@index')->name('subscriber.index');
    Route::delete('subscriber/{id}', 'SubscriberController@destroy')->name('subscriber.destroy');

});

Route::group(['as' => 'author.','prefix' => 'author','namespace' => 'Author','middleware' => ['auth','author']],function
(){
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');

    Route::get('favorite-post', 'FavoriteController@favoritePost')->name('favorite.post');

    Route::get('comment', 'CommentController@index')->name('comment.index');
    Route::delete('comment/{id}', 'CommentController@destroy')->name('comment.destroy');

    Route::get('settings', 'UserSettingsController@index')->name('settings');
    Route::put('profile-update', 'UserSettingsController@updateProfile')->name('profile.update');
    Route::put('password-change', 'UserSettingsController@changePassword')->name('password.change');

    Route::resource('post', 'PostController');

});

View::composer('layouts.frontend.includes.footer', function ($view){
    $categories = App\Category::all();
    $view->with('categories', $categories);
});
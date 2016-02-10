<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
use Bookcrossing\Http\Controllers\IndexController;
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    Route::get('/', ['middleware' => 'VKAuth', 'uses' => 'IndexController@index']);
    Route::get('auth', 'VKController@auth');
    Route::get('login', 'VKController@logIn');
    Route::get('logout', 'VKController@logOut');
    Route::get('addBook', ['middleware' => 'VKAuth', 'uses' => 'IndexController@create']);
    Route::post('store', ['middleware' => 'VKAuth', 'uses' => 'IndexController@store']);
    Route::get('recommendations', ['middleware' => 'VKAuth', 'uses' => 'PostController@index']);
    Route::get('addPost', ['middleware' => 'VKAuth', 'uses' => 'PostController@store']);
    Route::get('history', ['middleware' => 'VKAuth', 'uses' => 'HistoryController@index']);
    Route::get('post', ['middleware' => 'VKAuth', 'uses' => 'PostController@create']);
    Route::get('notifications', ['middleware' => 'VKAuth', 'uses' => 'NotifController@index']);
    Route::get('createN', ['middleware' => 'VKAuth', 'uses' => 'NotifController@create']);
    Route::get('take', ['middleware' => 'VKAuth', 'uses' => 'NotifController@create']);
    Route::get('refusal', ['middleware' => 'VKAuth', 'uses' => 'NotifController@create']);
    Route::get('cancel', ['middleware' => 'VKAuth', 'uses' => 'NotifController@destroy']);
    Route::get('accept', ['middleware' => 'VKAuth', 'uses' => 'IndexController@accept']);
    Route::post('update', ['middleware' => 'VKAuth', 'uses' => 'IndexController@update']);
    Route::get('myBooks', ['middleware' => 'VKAuth', 'uses' => 'IndexController@getMyBooks']);
    Route::get('takenBook', ['middleware' => 'VKAuth', 'uses' => 'IndexController@getTakenBook']);
    Route::get('return', ['middleware' => 'VKAuth', 'uses' => 'IndexController@returns']);
    Route::get('returnToOwner', ['middleware' => 'VKAuth', 'uses' => 'IndexController@returnToOwner']);
    Route::get('destroy', ['middleware' => 'VKAuth', 'uses' => 'IndexController@destroy']);
    Route::get('ver', ['uses' => 'IndexController@ver']);
    Route::get('faq', ['uses' => 'IndexController@faq']);
    Route::get('not', 'IndexController@not');
    Route::get('get', 'IndexController@get');
//завжди останній
    Route::get('/{book}', ['middleware' => 'VKAuth', 'uses' => 'IndexController@show']);
});

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

Route::get('auth/social', 'Auth\SocialAuthController@show')->name('social.login');
Route::get('oauth/{driver}', 'Auth\SocialAuthController@redirectToProvider')->name('social.oauth');
Route::get('oauth/{driver}/callback', 'Auth\SocialAuthController@handleProviderCallback')->name('social.callback');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/likes', 'Api\Social\LikeController@getLikesForCurrentUser');

Route::get('@{username}', 'Users\UserController@show');
Route::get('users', 'Users\UserController@index');
Route::get('account', 'Users\AccountController@getAccount');

Route::post('search', 'Search\SearchController@getResults');

Route::view('sponsors', 'static.sponsors');
Route::view('about', 'static.about');
Route::view('terms', 'static.terms');
Route::view('privacy', 'static.privacy');
Route::view('imprint', 'static.imprint');

Route::get('/test', function () {
    return response()->json(\PragmaRX\Countries\Package\Countries::all()->pluck('name'));
});

Route::group(['prefix' => 'forums'], function () {
    Route::view('/', 'forums.threads.list');
    Route::resource('categories', 'Forums\ThreadCategoryController');
    Route::resource('threads', 'Forums\ThreadController');
    Route::resource('threads.replies', 'Forums\ThreadReplyController');
});

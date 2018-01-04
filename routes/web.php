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

Route::group(['middleware' => ['auth'], 'prefix' => 'admin'], function() {
    Route::get('dashboard', 'PagesController@dashboard')->name('dashboard');
    Route::get('category/status/{id}/{status}', 'CategoryController@status')->name('categoryStatus');
    Route::resource('category', 'CategoryController');
    Route::get('question/status/{id}/{status}', 'QuestionController@status')->name('questionStatus');
    Route::resource('question', 'QuestionController');
    Route::get('setting', 'PagesController@settings')->name('setting');
    Route::get('profile', 'PagesController@profile')->name('profile');

    Route::post('createUser', 'PagesController@createUser')->name('createUser');
    Route::post('updatePassword', 'PagesController@updatePassword')->name('updatePassword');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

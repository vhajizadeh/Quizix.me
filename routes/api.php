<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('categories', 'PagesController@apiShowCategories');
Route::get('category/{id}', 'PagesController@apiShowSingleCategory');
Route::get('category/{id}/questions', 'PagesController@apiShowSingleCategoryQuestion');
Route::get('questions', 'PagesController@apiShowQuestions');
Route::get('question/{id}', 'PagesController@apiShowSingleQuestion');

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

//list Articles
// Route::get('articles', 'ArticleController@index');
// Route::get('articles/{id}', 'ArticleController@show');
// Route::post('articles', 'ArticleController@store');
// Route::put('articles', 'ArticleController@store');
// Route::delete('articles/{id}', 'ArticleController@destroy');

Route::group(['prefix' => '/articles', 'middleware' => ['auth:api']], function(){

  Route::get('/', 'ArticleController@index');
  Route::get('/{id}', 'ArticleController@show');
  Route::post('/', 'ArticleController@store');
  Route::put('/', 'ArticleController@store');
  Route::delete('/{id}', 'ArticleController@destroy');

});

Route::group(['prefix' => '/request/service', 'middleware' => ['auth:api']], function(){

  Route::get('/', 'ServiceRequestController@index');
  Route::get('/{id}', 'ServiceRequestController@show');
  Route::post('/', 'ServiceRequestController@store');
  Route::put('/', 'ServiceRequestController@store');
  Route::delete('/{id}', 'ServiceRequestController@destroy');

});

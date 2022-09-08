<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
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

Route::group([
    'prefix' => 'auth'

], function ($router) {
    Route::post('login', 'App\Http\Controllers\AuthController@login');
    Route::post('logout', 'App\Http\Controllers\AuthController@logout');
    Route::post('refresh', 'App\Http\Controllers\AuthController@refresh');
    Route::post('me', 'App\Http\Controllers\AuthController@me');
    Route::post('register', 'App\Http\Controllers\AuthController@register');
});

Route::group([
    'prefix' => 'match'
], function ($router) {
    Route::get('/{id}/users', 'App\Http\Controllers\MatchController@activeUsers');
    Route::get('/{id}/firstCard', 'App\Http\Controllers\MatchController@firstCard');
    Route::post('/{id}/firstGame', 'App\Http\Controllers\MatchController@firstGame');
    Route::post('register', 'App\Http\Controllers\MatchController@register');
    Route::post('/{id}/addUser/{userId}', 'App\Http\Controllers\MatchController@addUser');
    Route::post('/{id}/start', 'App\Http\Controllers\MatchController@startMatch');
    Route::get('/{id}/cards', 'App\Http\Controllers\MatchController@getCards');
});

Route::group([
    'prefix' => 'round'
], function ($router) {
    Route::post('/throwCard/match/{id}', 'App\Http\Controllers\RoundController@throwCard');
    Route::post('/{round}/compareCards', 'App\Http\Controllers\RoundController@compareCards');
});

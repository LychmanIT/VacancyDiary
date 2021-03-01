<?php

use App\Models\User;
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

Route::post('/register', '\App\Http\Controllers\Api\AuthController@register');
Route::post('/login', '\App\Http\Controllers\Api\AuthController@login');

Route::group(['middleware' => 'auth:api'], function () {
    Route::get('/user', '\App\Http\Controllers\Api\AuthController@user');
    Route::get('/delete_user', '\App\Http\Controllers\Api\AuthController@delete_user');

    Route::apiResource('{id}/vacancy', 'App\Http\Controllers\API\VacancyController');
    Route::post('/search', 'App\Http\Controllers\API\VacancyController@search');
    Route::get('{id}/vacancy/{vacancy_id}/send_mail', 'App\Http\Controllers\API\VacancyController@send_mail');
});

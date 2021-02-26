<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Vacancy;

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

Route::get('/', '\App\Http\Controllers\MainController@index');

Route::group(['prefix' => '{user_id}', 'middleware' => 'auth'], function () {
    Route::get('/vacancies', '\App\Http\Controllers\MainController@vacancies')->name('vacancies');

    Route::group(['prefix' => 'vacancy'], function () {
        Route::get('/create', '\App\Http\Controllers\VacancyController@create')->name('vacancy-create');
        Route::post('/store', '\App\Http\Controllers\VacancyController@store')->name('vacancy-store');
        Route::get('/{vacancy_id}', '\App\Http\Controllers\VacancyController@show')->name('vacancy-show');
        Route::get('/{vacancy_id}/edit', '\App\Http\Controllers\VacancyController@edit')->name('vacancy-edit');
        Route::post('/{vacancy_id}/update', '\App\Http\Controllers\VacancyController@update')->name('vacancy-update');
        Route::get('/{vacancy_id}/sendMail', '\App\Http\Controllers\Email\MailController@sendMail')->name('vacancy-mail');
    });
});

Route::get('/search', '\App\Http\Controllers\MainController@search')->name('search')->middleware('auth');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes([
    'confirm' => false,
    'verify' => false,
]);

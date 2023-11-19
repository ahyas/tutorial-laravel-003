<?php

use Illuminate\Support\Facades\Route;

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
})->name("welcome");

Route::get('kepegawaian/index', 'kepegawaian\KepegawaianController@index');
Route::get('kepegawaian/{id}/edit', 'kepegawaian\KepegawaianController@edit');
Route::put('kepegawaian/{id}/update', 'kepegawaian\KepegawaianController@update');
Route::get('kepegawaian/add', 'kepegawaian\KepegawaianController@add');
Route::post('kepegawaian/save', 'kepegawaian\KepegawaianController@save');
Route::get('kepegawaian/{id}/delete', 'kepegawaian\KepegawaianController@delete');
Route::get('kepegawaian/find', 'kepegawaian\KepegawaianController@find');
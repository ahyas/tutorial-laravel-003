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
Route::get('login', 'AuthController@showFormLogin')->name('login');
Route::post('login', 'AuthController@login');

Route::group(['middleware' => 'auth'], function () {
    Route::get('register', 'AuthController@showFormRegister')->name('register');
    Route::post('register', 'AuthController@register');

    Route::get('/home', 'HomeController@index')->name('home');
    Route::post("logout", "AuthController@logout")->name("logout");

    Route::get("/perkara", "PerkaraController@index")->name("perkara.index");
    Route::get("/perkara/{id_perkara}/pengajuan/{id_pihak}", "PerkaraController@pengajuan")->name("perkara.pengajuan");
    Route::get("/perkara/{id_perkara}/pengajuan/{id_pihak}/edit", "PerkaraController@edit")->name("perkara.pengajuan.edit");
    Route::post("/perkara/{id_perkara}/pengajuan/{id_pihak}/update", "PerkaraController@update")->name("perkara.pengajuan.update");
    Route::get("/perkara/{id_perkara}/pengajuan/{id_pihak}/kirim","PerkaraController@kirim")->name("perkara.pengajuan.kirim");

    Route::get("/permohonan", "PermohonanController@index")->name("permohonan.index");
    Route::get("/permohonan/{id_perkara}/pengajuan/{id_pihak}", "PermohonanController@pengajuan")->name("permohonan.pengajuan");
    Route::get("/permohonan/{id_perkara}/pengajuan/{id_pihak}/proses", "PermohonanController@proses")->name("permohonan.pengajuan.proses");
    Route::get("/permohonan/{id_perkara}/pengajuan/{id_pihak}/selesai", "PermohonanController@selesai")->name("permohonan.pengajuan.selesai");

    Route::get("/test_query", "PerkaraController@test_query");
});

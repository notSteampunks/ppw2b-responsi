<?php

use App\Homestay;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
Auth::routes();

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/listhomestay', 'ListHomestayController@index');
Route::get('/galerihomestay', 'GaleriController@index');
Route::get('/user', 'UserController@index');

// List Homestay section
Route::get('/listhomestay/create','ListHomestayController@create')->name('list.create');
Route::post('/listhomestay','ListHomestayController@store')->name('list.store');
Route::get('/listhomestay/edit/{id}','ListHomestayController@edit')->name('list.edit');
Route::post('/listhomestay/{id}','ListHomestayController@update')->name('list.update');
Route::post('/listhomestay/delete/{id}','ListHomestayController@destroy')->name('list.destroy');

Route::get('/listhomestay/search','ListHomestayController@search')->name('list.search');

Route::get('/listhomestay/homestay', 'ListHomestayController@homestay')->name('list.homestay');
Route::get('/detail-homestay/{title}', 'ListHomestayController@galhomestay')->name('list.detail');

Route::get('/listhomestay/homestay/{id}', 'ListHomestayController@likefoto')->name('like.foto');

Route::post('/list/detailhomestay/{id}', 'PostController@komentar')->name('detail.komentar');

//Galeri Homestay Section
Route::get('/galerihomestay/create','GaleriController@create')->name('galeri.create');
Route::post('/galerihomestay','GaleriController@store')->name('galeri.store');
// Route::get('/galerihomestay/edit/{id}','GaleriController@edit')->name('galeri.edit');
// Route::post('/galerihomestay/{id}','GaleriController@update')->name('galeri.update');
// Route::post('/galerihomestay','GaleriController@destroy')->name('galeri.destroy');

//User Section
Route::get('/user/edit/{id}','UserController@edit')->name('user.edit');
Route::post('/user/{id}','UserController@update')->name('user.update');
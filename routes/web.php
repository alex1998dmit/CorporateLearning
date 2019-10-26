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
    $client = new \GuzzleHttp\Client;
    $response = $client->get('https://laravel-corporate-learning.herokuapp.com/api/test');
    dd($response->getBody());
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

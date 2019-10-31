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

Auth::routes(['verify' => true]);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/test', function (Request $request) {
   return [
       'message' => $request->test_message,
       'client_secret' => $request->client_secret
   ];
});

Route::group([ 'prefix' => 'auth', 'namespace' => 'API' ], function () {
    Route::post('login', 'AuthController@login');
    Route::post('register', 'AuthController@register');

    Route::group([ 'middleware' => 'auth:api' ], function() {
        Route::post('logout', 'AuthController@logout');
        Route::get('about', 'AuthController@about');
    });
});

Route::group([ 'middleware' => 'auth:api' ], function() {
    // Courses
   Route::post('courses', 'CourseController@create');
    // Curators
   Route::post('curators', 'CuratorController@create');
    // Students
    Route::post('students', 'StudentController@create');
});

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

// companies
Route::get('companies/{id}', 'CompaniesController@show');

// curators
Route::get('curators/{id}', 'CuratorController@single');

// courses
Route::get('courses/{id}', 'CourseController@show');


// auth group
Route::group([ 'middleware' => 'auth:api' ], function() {
    // Courses
    Route::post('courses', 'CourseController@create');
    Route::put('courses/{id}', 'CourseController@update');
    Route::delete('courses/{id}', 'CourseController@delete');
    // Curators
    Route::post('curators', 'CuratorController@create');
    Route::delete('curators/{id}', 'CuratorController@delete');
    // Students
    Route::post('students', 'StudentController@create');
    Route::get('students/{id}', 'StudentsController@single');
    Route::delete('curators/{id}', 'CuratorController@delete');
    // Companies
    Route::get('companies/{id}/courses', 'CompaniesController@showCourses');
});

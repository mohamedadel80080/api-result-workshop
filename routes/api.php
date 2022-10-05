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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('students', 'App\Http\Controllers\ApiController@getAllStudents') ;
Route::post('students' , 'App\Http\Controllers\ApiController@createStudent');
Route::get('students/{id}', 'App\Http\Controllers\ApiController@getStudent');
Route::put('students/{id}', 'App\Http\Controllers\ApiController@updateStudent');
Route::delete('students/{id}','App\Http\Controllers\ApiController@deleteStudent');

//curses

Route::get('curses', 'App\Http\Controllers\CursesController@getAllCurses') ;
Route::post('curses' , 'App\Http\Controllers\CursesController@createCurses');
Route::get('curses/{id}', 'App\Http\Controllers\CursesController@getCurses');
Route::put('curses/{id}', 'App\Http\Controllers\CursesController@updateCurses');
Route::delete('curses/{id}','App\Http\Controllers\CursesController@deleteCurses');

//auth
Route::get('/users-data','App\Http\Controllers\ApiAuthController@allStudents');

Route::post('/handle-Register','App\Http\Controllers\ApiAuthController@handleRegister');
Route::post('/handle-login','App\Http\Controllers\ApiAuthController@handlelogin');
Route::post('/logout','App\Http\Controllers\ApiAuthController@logout');
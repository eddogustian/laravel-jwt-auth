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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::group(['prefix' => '/auth', ['middleware' => 'throttle:20,5']], function() {
//     Route::post('/register', 'Auth\RegisterController@register');
//     Route::post('/login', 'Auth\LoginController@login');
// });

// Login
Route::post('login', 'Auth\UsersController@authenticate');
Route::post('authenticate', 'Auth\UsersController@authenticate');
// Register
Route::post('register', 'Auth\UsersController@register');


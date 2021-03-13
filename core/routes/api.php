<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Providers\RouteServiceProvider;

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

Route::namespace(RouteServiceProvider::$apiNamespace)->group(function () {
    Route::namespace('Auth')->group(function () {
        Route::post('/register', 'AuthenticationController@register')->name('register');
        Route::post('/login', 'AuthenticationController@login')->name('login');

        Route::group(['middleware' => ['auth:sanctum']], function () {
            Route::post('/logout', 'AuthenticationController@logout')->name('logout');
        });
    });

    Route::group(['middleware' => ['auth:sanctum']], function () {
        Route::post('/update-user', 'UserController@update')->name('update-user');
        Route::post('/user/{user}/delete', 'UserController@delete')->name('delete-user');
    });
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

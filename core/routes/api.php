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
        Route::put('/user/{user}/delete', 'UserController@delete')->name('delete-user');

        Route::post('/company/create', 'CompanyController@create')->name('company-create');
        Route::post('/company/{company}/update', 'CompanyController@update')->name('company-update');
        Route::post('/company/{company}/delete', 'CompanyController@delete')->name('company-delete');

        Route::post('/signin', 'AttendanceController@signIn')->name('signin');
        Route::post('/signout', 'AttendanceController@signOut')->name('signout');

        Route::get('/departments', 'DepartmentController@getAll')->name('departments');
        Route::post('/department/create', 'DepartmentController@store')->name('department-create');
        Route::post('/department/{department}/update', 'DepartmentController@update')->name('department-update');
        Route::post('/department/{department}/delete', 'DepartmentController@delete')->name('department-delete');

        Route::get('/designations', 'DesignationController@getAll')->name('designations');
        Route::post('/designation/create', 'DesignationController@store')->name('designation-create');
        Route::post('/designation/{designation}/update', 'DesignationController@update')->name('designation-update');
        Route::post('/designation/{designation}/delete', 'DesignationController@delete')->name('designation-delete');

        Route::get('/leaves', 'LeaveController@getAll')->name('leaves');
        Route::post('/leave/request', 'LeaveController@store')->name('leave-request');
        Route::post('/leave/{leave}/update', 'LeaveController@update')->name('leave-update');
        Route::post('/leave/{leave}/accept', 'LeaveController@accept')->name('leave-accept');
        Route::post('/leave/{leave}/reject', 'LeaveController@reject')->name('leave-reject');
        Route::post('/leave/{leave}/delete', 'LeaveController@delete')->name('leave-delete');
    });
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user()->attendance;
});

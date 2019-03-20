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

Route::post('/login', 'UserController@login');
Route::post('/register', 'UserController@register');

Route::group(['middleware' => 'auth:api'], function(){

    Route::put('user/{id}/password', 'UserController@changePassword');
    Route::put('activity/{id}', 'ActivityController@store');
    Route::put('activity/{id}/book', 'ActivityController@book');
    Route::put('activity/{id}/cancel', 'ActivityController@cancel');

    Route::apiResources([
        'role' => 'RoleController',
        'room' => 'RoomController',
        'activitycategory' => 'ActivityCategoryController',
        'activity' => 'ActivityController',
        'user' => 'UserController',
        'roomproperty' => 'RoomPropertyController',
    ]);
});
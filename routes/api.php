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

Route::apiResources([
    'role' => 'RoleController',
    'room' => 'RoomController',
    'activitycategory' => 'ActivityCategoryController',
    'activity' => 'ActivityController',
    'user' => 'UserController',
    'roomproperty' => 'RoomPropertyController',

]);



/*

Route::post('/register', function (Request $request){
   return
       $request;
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->get('/room', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->get('/activity', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

*/

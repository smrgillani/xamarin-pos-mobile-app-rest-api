<?php

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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
return $request->user();
});*/

////////////////////////////*** Route Start ***/////////////////////////
//user post routes
Route::post('userRegistration', 'UserController@createUserRegistration');
Route::post('login', 'UserController@userLogin')->name('login');
//user get routes
Route::get('beacon', 'UserController@checkbeacon');
Route::get('userType', 'UserController@UserTypeDetails');
Route::middleware('auth:api')->get('allUserList', 'UserController@listUsers');
Route::middleware('auth:api')->get('userLogout', 'UserController@userLogout');
Route::group(['middleware' => ['auth:api', 'verifyUserAuthentication']], function () {
///////////// ******** user get route ******** ///////////// 
    Route::get('specificUser/{id}', 'UserController@specificUserDetail');
///////////// ******** profile post routes ******** ///////////// 
    Route::post('createProfile', 'ProfileController@createProfile');
    Route::post('updateProfile', 'ProfileController@updateProfile');
    Route::post('updateUserSpecificProfile', 'ProfileController@updateUserSpecificProfile');
///////////// ******** profile get routes ******** ///////////// 
    Route::get('specificProfile/{id}', 'ProfileController@specificProfileDetail');
    Route::get('userSpecificProfile', 'ProfileController@userSpecificProfileDetail');
    Route::get('profileList', 'ProfileController@listProfile');
///////////// ******** profile del routes ******** /////////////
    Route::delete('deleteProfile/{id}', 'ProfileController@deleteProfile');
///////////// ******** schedule post routes ******** /////////////
    Route::post('createSchedule', 'ScheduleController@createSchedule');
    Route::post('updateSchedule', 'ScheduleController@updateSchedule');
///////////// ******** schedule get routes ******** /////////////
    Route::get('scheduleList/{profileId}', 'ScheduleController@listSchedule');
    Route::get('specificSchedule/{id}', 'ScheduleController@specificScheduleDetail');
///////////// ******** schedule del routes ******** /////////////
    Route::delete('deleteSchedule/{id}', 'ScheduleController@deleteSchedule');
///////////// ******** table post routes ******** /////////////
    Route::post('createTable', 'TableController@createTable');
    Route::post('updateTable', 'TableController@updateTable');
///////////// ******** table get routes  ******** /////////////
    Route::get('tableList/{profileId}', 'TableController@listTable');
    Route::get('specificTable/{id}', 'TableController@specificTableDetail');
    Route::get('profileAvailableTable/{profileId}', 'TableController@profileAvailableTable');
///////////// ******** table del routes ******** /////////////
    Route::delete('deleteTable/{id}', 'TableController@deleteTable');
///////////// ******** Order post routes ******** /////////////
    Route::post('createOrder', 'OrderController@createOrder');
    Route::post('updateOrder', 'OrderController@updateOrder');
///////////// ******** Order get routes ******** /////////////
    Route::get('listOrder', 'OrderController@listOrder');
    Route::get('specificOrder/{id}', 'OrderController@specificOrderDetail');
    Route::get('specificLogedInUserOrderDetail', 'OrderController@specificlogedInUserPerviousOrderDetail');
    Route::get('specificUpcomingUserOrder', 'OrderController@specificUpcomingUserOrder');

});

////////////////////////////*** Route End ***////////////////////////////

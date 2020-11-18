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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// getting all settings data
Route::get('/v1/generalsetting', 'API\SwiftApiController@getAllsettings');

// user register, login and logout by mobile iOS
Route::POST('/v1/emailverify', 'Admin\UsersController@emailverify');
Route::POST('/v1/register', 'Admin\UsersController@store');
Route::POST('/v1/loginUser', 'Admin\UsersController@loginUser');
Route::POST('/v1/logout', 'Admin\UsersController@logout');

// getting all category data
Route::get('/v1/categories', 'API\SwiftApiController@getAllcategories');

// getting all vendors data by categoryId
Route::get('/v1/vendros', 'API\SwiftApiController@getAllvendors');

// getting discount lists by vendor Id
Route::get('/v1/getdiscountlistsbyvendor', 'API\SwiftApiController@getDiscountlistsByVendor');

// getting discount detail one item by Id
Route::get('/v1/getdetaildiscountbyid', 'API\SwiftApiController@getDetaildiscountById');

//register with facebook
Route::get('/v1/redirectfb', 'Auth\LoginController@redirectToProviderfacebook');
Route::get('/callbackfb', 'Auth\LoginController@handleProviderCallbackfacebook');
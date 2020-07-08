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

Route::middleware('auth:api')->get('/user', function (Request $request) {
	return $request->user();
});

Route::post('signup', 'Api\AuthApiController@signup');
Route::post('login', 'Api\AuthApiController@login');
Route::post('forgot-password', 'Api\AuthApiController@forgetPassword');
// retaurant apis
Route::post('restaurantlogin', 'Api\RestaurantApiController@login');
Route::post('restaurant/dashboard', 'Api\RestaurantApiController@dashboard');
///////////////////////////////////
Route::group(['middleware' => 'auth:api'], function () {
	Route::get('get-profile', 'Api\CustomerApiController@profile');
	Route::post('update-profile', 'Api\CustomerApiController@updateProfile');
	Route::post('update-profile-picture', 'Api\CustomerApiController@updateProfilePicture');
	Route::post('change-password', 'Api\CustomerApiController@changePassword');
});

Route::group(['middleware' => 'auth:api'], function () {
	Route::get('get-slider', 'Api\HardeesApiController@getSlider');
	Route::get('get-menu-', 'Api\HardeesApiController@menu');
	Route::get('get-single-items', 'Api\HardeesApiController@singleItems');
	Route::get('get-special-offers', 'Api\HardeesApiController@getSpecialOffers');
	Route::get('get-categories', 'Api\HardeesApiController@getCategories');
	Route::post('get-menu-items', 'Api\HardeesApiController@menuItems');
	Route::get('get-deals', 'Api\HardeesApiController@getDeals');
	Route::post('create-customer-deal', 'Api\HardeesApiController@createCustomDeal');
});

Route::group(['middleware' => 'auth:api'], function () {
	Route::post('place-order', 'Api\OrderApiController@placeOrder');
});

Route::post('add-to-cart', 'Api\OrderApiController@addCart');
Route::post('get-cart', 'Api\OrderApiController@addCart');


// Rider Api Starting Point By Qadeer
Route::post('rider-register', 'Api\RiderApiController@riderRegister');
Route::post('rider-login', 'Api\RiderApiController@riderLogin');

Route::post('request-accept', 'Api\RiderApiController@requestAccepted');

Route::post('request-rejected', 'Api\RiderApiController@requestRejected');

Route::post('store-review', 'Api\RiderApiController@storeReview');

Route::post('earning-detail', 'Api\RiderApiController@earningDetail');

// Rider Api Ending Point By Qadeer
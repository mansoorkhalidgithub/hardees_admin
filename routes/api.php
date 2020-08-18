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

// retaurant apis
Route::post('restaurantlogin', 'Api\RestaurantApiController@login');
Route::group(['middleware' => 'auth:api'], function () {
	Route::get('restaurant/dashboard-today', 'Api\RestaurantApiController@dashboardByToday');
	Route::get('restaurant/dashboard-week', 'Api\RestaurantApiController@dashboardByWeek');
	Route::get('restaurant/dashboard-month', 'Api\RestaurantApiController@dashboardByMonth');
	Route::get('restaurant/orderprocessing', 'Api\RestaurantApiController@orderProcessing');
	Route::post('restaurant/order-accepted', 'Api\RestaurantApiController@orderAccepted');
	Route::get('restaurant/recent-allorders', 'Api\RestaurantApiController@recentAllOrders');
	Route::get('restaurant/recent-todayorders', 'Api\RestaurantApiController@recentTodayOrders');
	Route::get('restaurant/recent-yesterdayorders', 'Api\RestaurantApiController@recentYesterdayOrders');
	Route::post('restaurant/order-readyforpickup', 'Api\RestaurantApiController@orderReadyForPickup');
});

// Route::group(['middleware' => 'auth:api'], function () {;});
///////////////////////////////////

/********** Start Customer Side API's ***************************/

Route::post('signup', 'Api\AuthApiController@signup');
Route::post('login', 'Api\AuthApiController@login');
Route::post('forgot-password', 'Api\AuthApiController@forgetPassword');

Route::group(['middleware' => 'auth:api'], function () {
	Route::get('get-profile', 'Api\CustomerApiController@profile');
	Route::post('update-profile', 'Api\CustomerApiController@updateProfile');
	Route::post('update-profile-picture', 'Api\CustomerApiController@updateProfilePicture');
	Route::post('change-password', 'Api\CustomerApiController@changePassword');
});

Route::group(['middleware' => 'auth:api'], function () {
	Route::get('get-slider', 'Api\HardeesApiController@getSlider');
	Route::get('get-menu', 'Api\HardeesApiController@menu');
	Route::get('get-single-items', 'Api\HardeesApiController@singleItems');
	Route::get('get-special-offers', 'Api\HardeesApiController@getSpecialOffers');
	Route::get('get-categories', 'Api\HardeesApiController@getCategories');
	Route::post('get-menu-items', 'Api\HardeesApiController@menuItems');
	Route::get('get-deals', 'Api\HardeesApiController@getDeals');
	Route::post('create-customer-deal', 'Api\HardeesApiController@createCustomDeal');
});

Route::group(['middleware' => 'auth:api'], function () {
	Route::post('place-order', 'Api\OrderApiController@placeOrder');
	Route::post('menu', 'Api\OrderApiController@getMenu');
	Route::post('menu-item', 'Api\OrderApiController@getMenuItems');
	Route::post('variations', 'Api\OrderApiController@variations');
});

Route::group(['middleware' => 'auth:api'], function () {
	Route::post('add-to-cart', 'Api\OrderApiController@addCart');
	Route::post('update-cart', 'Api\OrderApiController@updateCart');
	Route::post('get-cart', 'Api\OrderApiController@getCart');
	Route::post('add-quantity', 'Api\OrderApiController@addQuantity');
	Route::post('remove-quantity', 'Api\OrderApiController@removeQuantity');
	Route::delete('delete-cart', 'Api\OrderApiController@deleteCart');
	Route::post('checkout', 'Api\OrderApiController@checkout');
});

/********** End Customer Side API's ***************************/

// Rider Api Starting Point By Qadeer
Route::post('rider-register', 'Api\RiderApiController@riderRegister');

Route::post('rider-login', 'Api\RiderApiController@riderLogin');
Route::group(['middleware' => 'auth:api'], function () {
	Route::post('tripmanage', 'Api\RiderApiController@tripManage');

	Route::post('request-rejected', 'Api\RiderApiController@requestRejected');

	Route::post('store-review', 'Api\RiderApiController@storeReview');

	Route::post('earning-detail', 'Api\RiderApiController@earningDetail');

	Route::post('rider-detail', 'Api\RiderApiController@riderDetail');

	Route::post('update-profile', 'Api\RiderApiController@updateProfile');

	Route::post('delivery-detail', 'Api\RiderApiController@deliveryDetail');

	Route::post('order-history', 'Api\RiderApiController@ordersHistory');

	Route::post('rider-status', 'Api\RiderApiController@riderStatus');

	Route::post('rider-logout', 'Api\RiderApiController@logout');
});

// Route::group(['middleware' => 'auth:api'], function () {
// 	Route::post('trip-manage', 'Api\RiderAuthController@tripManage');
// });
// Rider Api Ending Point By Qadeer


Route::post('test-notification', 'Api\OrderApiController@notification');

Route::post('notification-test', 'Api\RiderApiController@token');

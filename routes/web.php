<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */


Route::get('/', function () {
	return view('welcome');
});

Route::get('/testing', function () {
	return view('new_booking_form');
});

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('dashboard');

Route::get('/clear', function () {

	Artisan::call('cache:clear');
	Artisan::call('config:clear');
	Artisan::call('config:cache');
	Artisan::call('view:clear');

	return "Cleared!";
});

Route::group([
	'middleware' => 'auth',
], function () {
	Route::get('dashboard', 'HomeController@index')->name('dashboard');
	Route::post('chart', 'HomeController@chart')->name('api.chart');
	Route::get('menu-categories', 'MenuController@menuCategories')->name('menu-categories');
	Route::get('menu', 'MenuController@index')->name('menu');
	Route::get('orders', 'OrderController@index')->name('orders');
	Route::get('customers', 'CustomerController@index')->name('customers');
	// Route::get('riders', 'RiderController@index')->name('riders');
	Route::get('inbox', 'HomeController@message')->name('inbox');
	Route::get('app-sliders', 'HomeController@appSiders')->name('app-sliders');
	Route::get('tax-setting', 'HomeController@taxSetting')->name('tax-setting');
	Route::get('manage-currency', 'HomeController@manageCurrency')->name('manage-currency');
	Route::get('rider-request', 'RiderController@requests')->name('rider-request');
	Route::get('push-notifications', 'HomeController@notifications')->name('push-notifications');
	Route::get('earnings', 'HomeController@earnings')->name('earnings');
	Route::get('transactions', 'HomeController@transactions')->name('transactions');
});

Route::group([
	'middleware' => 'auth',
], function () {
	Route::get('orders', 'OrderController@index')->name('orders');
	Route::get('new-orders', 'OrderController@newOrders')->name('new-orders');
	Route::get('booking', 'BookingController@index')->name('booking');
	Route::post('getCustomer', 'BookingController@getCustomer')->name('customer.info');
	Route::get('order-status', 'OrderController@orderStatus')->name('order-status');
	Route::get('view-order', 'OrderController@view')->name('view-order');
	Route::get('edit-order', 'OrderController@edit')->name('edit-order');
});

Route::group([
	'middleware' => 'auth',
], function () {
	Route::get('restaurants', 'RestaurantController@index')->name('restaurants');
	Route::get('add-restaurant', 'RestaurantController@add')->name('add-restaurant');
	Route::get('edit-restaurant/{id}', 'RestaurantController@edit')->name('restaurant.edit');
	Route::post('update-restaurant', 'RestaurantController@update')->name('restaurant.update');
	Route::post('save-restaurant', 'RestaurantController@store')->name('save-restaurant');
	Route::get('show-restaurant/{id}', 'RestaurantController@show')->name('restaurant.show');
	Route::post('destroy-restaurant', 'RestaurantController@destroy')->name('restaurant.destroy');
	Route::post('branch-chart', 'RestaurantController@chart')->name('branch.chart');
	Route::get('status/{id}', 'RestaurantController@status')->name('restaurant.status');
});

Route::group([
	'middleware' => 'auth',
], function () {
	Route::get('auth-user', 'AuthController@index')->name('auth.index');
	Route::get('add-auth', 'AuthController@create')->name('auth.create');
	Route::get('edit-auth/{id}', 'AuthController@edit')->name('auth.edit');
	Route::post('update-auth', 'AuthController@update')->name('auth.update');
	Route::post('save-auth', 'AuthController@store')->name('auth.store');
	Route::get('show-auth/{id}', 'AuthController@show')->name('auth.show');
	Route::post('destroy-auth', 'AuthController@destroy')->name('auth.destroy');
	Route::get('status/{id}', 'AuthController@status')->name('auth.status');
});

Route::group([
	'middleware' => 'auth',
], function () {
	Route::get('state', 'StateController@index')->name('state.index');
	Route::get('state/status/{id}', 'StateController@status')->name('state.status');
});

Route::group([
	'middleware' => 'auth',
], function () {
	Route::get('city', 'CityController@index')->name('city.index');
	Route::get('city/status/{id}', 'CityController@status')->name('city.status');
});
Route::group([
	'middleware' => 'auth',
], function () {
	Route::get('/booking_show', 'HomeController@booking_show')->name('booking_show');
	Route::get('/complete', 'DeliveryController@complete')->name('delivery.complete');
	Route::get('/progress', 'DeliveryController@progress')->name('delivery.progress');
	Route::get('/delivery_log/{id}', 'HomeController@delivery_log')->name('delivery_log');
});
Route::group([
	'middleware' => 'auth',
], function () {
	Route::get('users', 'UserController@index')->name('users');
	Route::get('add-user/{title}', 'UserController@add')->name('user.add');
	Route::get('edit-user/{id}/{title}', 'UserController@edit')->name('user.edit');
	Route::post('update-user', 'UserController@update')->name('user.update');
	Route::post('save-user', 'UserController@store')->name('user.store');
	Route::get('show-user/{id}/{title}', 'UserController@show')->name('user.show');
	Route::post('destroy-user', 'UserController@destroy')->name('user.destroy');
	Route::post('info', 'UserController@info')->name('info');
});

Route::group([
	'middleware' => 'auth',
], function () {
	Route::get('riders', 'RiderController@index')->name('rider.index');
	Route::get('add-rider', 'RiderController@create')->name('rider.create');
	Route::get('edit-rider/{id}', 'RiderController@edit')->name('rider.edit');
	Route::post('update-rider', 'RiderController@update')->name('rider.update');
	Route::post('save-rider', 'RiderController@store')->name('rider.store');
	Route::get('show-rider/{id}', 'RiderController@show')->name('rider.show');
	Route::post('destroy-rider', 'RiderController@destroy')->name('rider.destroy');
	Route::post('info', 'RiderController@info')->name('rider.info');
	Route::get('/delivery_boy_management', 'RiderController@delivery_boy_management')->name('rider.management');
	Route::get('rider/status/{id}', 'RiderController@status')->name('rider.status');
	Route::get('rider/eStatus/{id}', 'RiderController@eStatus')->name('rider.eStatus');
	Route::get('rider/trip_status/{id}', 'RiderController@tripStatus')->name('rider.tripstatus');
	Route::post('getCities', 'RiderController@getCities')->name('getCities');
	Route::post('getBranches', 'RiderController@getBranches')->name('rider.branch');
	Route::post('getStates', 'RiderController@getStates')->name('rider.states');
});

Route::group([
	'middleware' => 'auth',
], function () {
	Route::get('sliders', 'SliderController@index')->name('slider.index');
	Route::get('add-slider', 'SliderController@create')->name('slider.create');
	Route::get('edit-slider/{id}', 'SliderController@edit')->name('slider.edit');
	Route::post('update-slider', 'SliderController@update')->name('slider.update');
	Route::post('save-slider', 'SliderController@store')->name('slider.store');
	Route::get('show-slider/{id}', 'SliderController@show')->name('slider.show');
	Route::post('destroy-slider', 'SliderController@destroy')->name('slider.destroy');
});

Route::group([
	'middleware' => 'auth',
], function () {
	Route::get('restaurant-users', 'RestaurantUserController@index')->name('restaurant-users');
	Route::get('add-restaurant-user', 'RestaurantUserController@create')->name('add-restaurant-user');
	Route::post('save-restaurant-user', 'RestaurantUserController@save')->name('save-restaurant-user');
});
Route::group([
	'middleware' => 'auth',
], function () {

	Route::get('menu-categories', 'MenuController@menuCategories')->name('menu-categories');
	Route::get('create-category', 'MenuController@create')->name('create-category');
	Route::post('add-category', 'MenuController@addCategory')->name('add-category');
	Route::get('edit-category/{id}', 'MenuController@editCategory')->name('edit-category');
	Route::post('update-category', 'MenuController@updateCategory')->name('update-category');

	Route::get('menu-items', 'MenuController@index')->name('menu-items');
	Route::get('create-menu-item', 'MenuController@createMenuItem')->name('create-menu-item');
	Route::post('add-menu-items', 'MenuController@addMenuItems')->name('add-menu-items');
	Route::get('edit-menu/{id}', 'MenuController@editMenu')->name('edit-menu');
	Route::get('show-menu-item/{id}', 'MenuController@show')->name('show');
	Route::post('update-menu-item', 'MenuController@updateMenuItem')->name('update-menu-item');

	Route::get('deals', 'DealController@index')->name('deals');
	Route::get('special-offers', 'DealController@specialOffers')->name('special-offers');
});

Route::group([
	'middleware' => 'auth',
], function () {
	Route::get('menu-variation', 'VariationController@create')->name('menu-variation');
	Route::post('save-variation', 'VariationController@save')->name('save-variation');
	Route::get('manage-deal', 'VariationController@manageDeal')->name('manage-deal');
});
Route::group([
	'middleware' => 'auth',
], function () {
	Route::get('version', 'VersionController@index')->name('version.index');
	Route::get('edit-version/{id}', 'VersionController@edit')->name('version.edit');
	Route::post('update-version', 'VersionController@update')->name('version.update');
});

Route::group(['middleware' => 'auth'], function () {
	Route::post('search-customer', 'OrderController@searchCustomer')->name('search-customer');
	Route::post('nearest-restuarant', 'OrderController@nearestRestaurant')->name('nearest-restuarant');
	Route::post('save-order', 'OrderController@save')->name('save-order');
	Route::get('order-summary', 'OrderController@summary')->name('order-summary');
	Route::get('resend/{id}', 'OrderController@resend')->name('resend');
	Route::post('resend-order', 'OrderController@resendOrder')->name('resend-order');
	Route::get('order/trip_status/{id}', 'OrderController@tripStatus')->name('order.tripstatus');
	Route::post('send-notification', 'OrderController@notification')->name('send-notification');
});

Route::group(['middleware' => 'auth'], function () {
	Route::post('get-menu-items', 'MenuController@menuItems')->name('get-menu-items');
});

Route::group(['middleware' => 'auth'], function () {
	Route::post('add-to-cart', 'Api\OrderApiController@addCart')->name('add-to-cart');
	Route::post('remove-to-cart', 'Api\OrderApiController@removeCartItem')->name('remove-to-cart');
	Route::post('get-cart', 'Api\OrderApiController@getCart')->name('get-cart');
	Route::post('add-quantity', 'Api\OrderApiController@addQuantity')->name('add-quantity');
	Route::post('remove-quantity', 'Api\OrderApiController@removeQuantity')->name('remove-quantity');
	Route::delete('delete-cart', 'Api\OrderApiController@deleteCart')->name('delete-cart');
	Route::post('checkout', 'Api\OrderApiController@checkout')->name('checkout');
});

Route::group(['middleware' => 'auth'], function () {
	Route::post('item-variations', 'VariationController@variations')->name('item-variations');
	Route::post('variation-items', 'VariationController@items')->name('variation-items');
	Route::post('add-to-bucket', 'VariationController@addToBucket')->name('add-to-bucket');
	Route::post('saveOrder', 'OrderController@saveOrder')->name('saveOrder');
	Route::post('remove-order-item', 'OrderController@removeOrderItem')->name('remove-order-item');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Waqar Ahmad Routes

//Route::get('/booking', 'HomeController@booking')->name('booking');

Route::get('/restaurant_show', 'HomeController@restaurant_show')->name('restaurant_show');

Route::get('/ride_statement', 'HomeController@ride_statement')->name('ride_statement');

Route::get('/product', 'HomeController@product')->name('product');

Route::get('/category', 'HomeController@category')->name('category');

Route::get('/restaurant_new', 'HomeController@restaurant_new')->name('restaurant_new');

Route::get('/view_restaurant', 'HomeController@view_restaurant')->name('view_restaurant');

Route::get('/update_restaurant', 'HomeController@update_restaurant')->name('update_restaurant');


Route::get('/update_delivery', 'HomeController@update_delivery')->name('update_delivery');

Route::get('/add_product', 'HomeController@add_product')->name('add_product');

Route::get('/update_product', 'HomeController@update_product')->name('update_product');

Route::get('/add_category', 'HomeController@add_category')->name('add_category');

Route::get('/update_category', 'HomeController@update_category')->name('update_category');

Route::get('/sub_admins', 'HomeController@sub_admins')->name('sub_admins');
Route::get('/create_sub_admins', 'HomeController@create_sub_admins')->name('create_sub_admins');
Route::get('/view_sub_admins', 'HomeController@view_sub_admins')->name('view_sub_admins');
Route::get('/update_sub_admins', 'HomeController@update_sub_admins')->name('update_sub_admins');
Route::get('/user_list', 'HomeController@user_list')->name('user_list');
Route::get('/create_user_list', 'HomeController@create_user_list')->name('create_user_list');
Route::get('/update_user_list', 'HomeController@update_user_list')->name('update_user_list');
Route::get('/view_user_list', 'HomeController@view_user_list')->name('view_user_list');
Route::get('/zone_list', 'HomeController@zone_list')->name('zone_list');
Route::get('/add_zone', 'HomeController@add_zone')->name('add_zone');
Route::get('/update_zone', 'HomeController@update_zone')->name('update_zone');
// Route::get('/delivery_boy_management', 'HomeController@delivery_boy_management')->name('delivery_boy_management');
Route::get('/delivery_boy_payment', 'HomeController@delivery_boy_payment')->name('delivery_boy_payment');
Route::get('/riders_details', 'HomeController@riders_details')->name('riders_details');
Route::get('/add_rider', 'HomeController@add_rider')->name('add_rider');
Route::get('/view_riders_details', 'HomeController@view_riders_details')->name('view_riders_details');
Route::get('/update_riders_details', 'HomeController@update_riders_details')->name('update_riders_details');
Route::get('/applicants', 'HomeController@applicants')->name('applicants');
Route::get('/applicants_results', 'HomeController@applicants_results')->name('applicants_results');
Route::get('/applicants_shortlisted', 'HomeController@applicants_shortlisted')->name('applicants_shortlisted');
Route::get('/promocode_list', 'HomeController@promocode_list')->name('promocode_list');
Route::get('/update_promocode', 'HomeController@update_promocode')->name('update_promocode');
Route::get('/view_promocode', 'HomeController@view_promocode')->name('view_promocode');
Route::get('/add_promocode', 'HomeController@add_promocode')->name('add_promocode');
Route::get('/reviews', 'HomeController@reviews')->name('reviews');
Route::get('/service_type', 'HomeController@service_type')->name('service_type');
Route::get('/add_service_type', 'HomeController@add_service_type')->name('add_service_type');
Route::get('/update_service_type', 'HomeController@update_service_type')->name('update_service_type');
Route::get('/view_service_type', 'HomeController@view_service_type')->name('view_service_type');
Route::get('/service_area', 'HomeController@service_area')->name('service_area');
Route::get('/new_area', 'HomeController@new_area')->name('new_area');
Route::get('/view_area', 'HomeController@view_area')->name('view_area');
Route::get('/update_area', 'HomeController@update_area')->name('update_area');
Route::get('/add_state', 'HomeController@add_state')->name('add_state');
Route::get('/update_state', 'HomeController@update_state')->name('update_state');
Route::get('/add_city', 'HomeController@add_city')->name('add_city');
Route::get('/update_city', 'HomeController@update_city')->name('update_city');
/********************************** restaurant user ******************************************/
Route::group([
	'middleware' => 'auth',
], function () {
	Route::get('/restaurants-user', 'RestaurantController@getrestaurantUser')->name('restaurant.user');
	Route::get('add-restaurants-user', 'RestaurantController@createUser')->name('restaurant.create-user');
	Route::post('store-restaurant-user', 'RestaurantController@storeRestaurantUser')->name('store-restaurant-user');
});
Route::get('jsonobj', 'HomeController@jsonObj')->name('json');

Route::get('order-detail', 'HomeController@orderDetail')->name('order.detail');

//forgot password
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
//Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
//Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset.token');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');


Route::group([    
    //'namespace' => 'mobile',    
    //'middleware' => 'api',    
    'prefix' => 'mobile/password'
], function () {    
    //Route::get('find/{token}', 'PasswordResetController@find');

    //Route::post('create', 'PasswordResetController@create');
    Route::get('reset-form/{token}', 'Api\PasswordResetController@resetForm');
    Route::post('reset', 'Api\PasswordResetController@reset')->name('api.password.reset');
});

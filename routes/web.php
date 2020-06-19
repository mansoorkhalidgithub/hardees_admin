<?php

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

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('dashboard');

Route::group([
	'middleware' => 'auth'
], function () {
	Route::get('dashboard', 'HomeController@index')->name('dashboard');
	Route::get('menu-categories', 'MenuController@menuCategories')->name('menu-categories');
	Route::get('menu', 'MenuController@index')->name('menu');
	Route::get('orders', 'OrderController@index')->name('orders');
	Route::get('customers', 'CustomerController@index')->name('customers');
	Route::get('riders', 'RiderController@index')->name('riders');
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
	'middleware' => 'auth'
], function () {
	Route::get('restaurants', 'RestaurantController@index')->name('restaurants');
	Route::get('add-restaurant', 'RestaurantController@add')->name('add-restaurant');
	Route::get('edit-restaurant/{id}', 'RestaurantController@edit')->name('restaurant.edit');
	Route::post('update-restaurant', 'RestaurantController@update')->name('restaurant.update');
	Route::post('save-restaurant', 'RestaurantController@store')->name('save-restaurant');
	Route::get('show-restaurant/{id}', 'RestaurantController@show')->name('restaurant.show');
	Route::post('destroy-restaurant', 'RestaurantController@destroy')->name('restaurant.destroy');
});

Route::group([
	'middleware' => 'auth'
], function () {
	Route::get('users', 'UserController@index')->name('users');
	Route::get('add-user/{title}', 'UserController@add')->name('user.add');
	Route::get('edit-user/{id}', 'UserController@edit')->name('user.edit');
	Route::post('update-user', 'UserController@update')->name('user.update');
	Route::post('save-user', 'UserController@store')->name('user.store');
	Route::get('show-user/{id}/{title}', 'UserController@show')->name('user.show');
	Route::post('destroy-user', 'UserController@destroy')->name('user.destroy');
	Route::post('info', 'UserController@info')->name('info');
});


Route::group([
	'middleware' => 'auth'
], function () {
	Route::get('sliders', 'SliderController@index')->name('sliders');
	Route::get('add-slider', 'SliderController@create')->name('slider.create');
	Route::get('edit-slider/{id}', 'SliderController@edit')->name('slider.edit');
	Route::post('update-slider', 'SliderController@update')->name('slider.update');
	Route::post('save-slider', 'SliderController@store')->name('slider.store');
	Route::get('show-slider/{id}', 'SliderController@show')->name('slider.show');
	Route::post('destroy-slider', 'SliderController@destroy')->name('slider.destroy');
});


Route::group([
	'middleware' => 'auth'
], function () {
	Route::get('restaurant-users', 'RestaurantUserController@index')->name('restaurant-users');
	Route::get('add-restaurant-user', 'RestaurantUserController@create')->name('add-restaurant-user');
	Route::post('save-restaurant-user', 'RestaurantUserController@save')->name('save-restaurant-user');
});
Route::group([
	'middleware' => 'auth'
], function () {
	//menue catgory
	Route::get('menu-categories', 'MenuController@menuCategories')->name('menu-categories');
	Route::get('create-category', 'MenuController@create')->name('create-category');
	Route::post('add-category', 'MenuController@addCategory')->name('add-category');
	Route::get('edit-category/{id}', 'MenuController@editCategory')->name('edit-category');
	Route::post('update-category', 'MenuController@updateCategory')->name('update-category');
	//menue
	Route::get('create-menu-item', 'MenuController@createMenuItem')->name('create-menu-item');
	Route::post('add-menu-items', 'MenuController@addMenuItems')->name('add-menu-items');
	Route::get('edit-menu/{id}', 'MenuController@editMenu')->name('edit-menu');
	Route::post('update-menu-item', 'MenuController@updateMenuItem')->name('update-menu-item');


	//Route::get('add-menu-category', 'MenuController@addCategory')->name('add-menu-category');
	//Route::get('add-menu-item', 'AuthController@create')->name('add-menu-item');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

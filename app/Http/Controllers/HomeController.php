<?php

namespace App\Http\Controllers;

class HomeController extends Controller {
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Contracts\Support\Renderable
	 */
	public function index() {
		return view('home');
	}
//
	//
	//
	//
	//
	//
	//

	//
	//
	//
	//

	//Waqar Ahmad View

	public function booking() {
		return view('Delivery/booking_form');
	}

	public function booking_show() {
		return view('Delivery/trips');
	}

	public function restaurant_show() {
		return view('restaurant/restaurant_list');
	}

	public function restaurant_new() {
		return view('restaurant/create_restaurant');
	}

	public function update_restaurant() {
		return view('restaurant/update_restaurant');
	}

	public function view_restaurant() {
		return view('restaurant/view_restaurant');
	}

	public function ride_statement() {
		return view('rider/delivery_statements');
	}

	public function delivery_log() {
		return view('Delivery/delivery_log');
	}

	public function update_delivery() {
		return view('Delivery/update_booking');
	}

	public function add_product() {
		return view('menu/create-menu');
	}

	public function update_product() {
		return view('menu/edit-menu');
	}

	public function add_category() {
		return view('menu/create-category');
	}

	public function update_category() {
		return view('menu/edit-category');
	}

	public function product() {
		return view('menu/index');
	}

	public function category() {
		return view('menu/menu-categories');
	}

	public function sub_admins() {
		return view('authUser/sub_admin_list');
	}
	public function create_sub_admins() {
		return view('authUser/add_sub_admin');
	}
	public function view_sub_admins() {
		return view('authUser/view_sub_admin');
	}
	public function update_sub_admins() {
		return view('authUser/edit_sub_admin');
	}
	public function user_list() {
		return view('user/user_details');
	}
	public function update_user_list() {
		return view('user/edit_user');
	}

	public function view_user_list() {
		return view('user/view_user');
	}

	public function create_user_list() {
		return view('user/add_user');
	}

	public function zone_list() {
		return view('Zone/zone_list');
	}
	public function add_zone() {
		return view('Zone/add_new_zone');
	}
	public function update_zone() {
		return view('Zone/update_zone');
	}

	public function delivery_boy_management() {
		return view('Rider/delivery_boy_management');
	}
	public function delivery_boy_payment() {
		return view('Rider/delivery_boy_payment_details');
	}

	public function applicants() {
		return view('Job Management/resume_list');
	}
	public function applicants_results() {
		return view('Job Management/result_list');
	}
	public function applicants_shortlisted() {
		return view('Job Management/shortlisted_candidates');
	}

	public function riders_details() {
		return view('Rider/rider_list');
	}
	public function add_rider() {
		return view('Rider/add_rider');
	}
	public function view_riders_details() {
		return view('Rider/view_rider');
	}
	public function update_riders_details() {
		return view('Rider/update_rider');
	}

	public function promocode_list() {
		return view('Promocode/promocode_list');
	}
	public function update_promocode() {
		return view('Promocode/update_promocode');
	}
	public function view_promocode() {
		return view('Promocode/view_promocode');
	}
	public function add_promocode() {
		return view('Promocode/add_promocode');
	}

	public function reviews() {
		return view('rating');
	}

	public function service_type() {
		return view('Services/service_type');
	}
	public function add_service_type() {
		return view('Services/new_vehicle');
	}
	public function update_service_type() {
		return view('Services/update_vehicle');
	}
	public function view_service_type() {
		return view('Services/view_vehicle');
	}

	public function service_area() {
		return view('Areas/service_area');
	}
	public function new_area() {
		return view('Areas/new_area');
	}
	public function view_area() {
		return view('Areas/view_area');
	}
	public function update_area() {
		return view('Areas/update_area');
	}

	public function state() {
		return view('State/state_list');
	}
	public function add_state() {
		return view('State/add_state');
	}
	public function update_state() {
		return view('State/update_state');
	}

	public function city() {
		return view('City/city_list');
	}
	public function add_city() {
		return view('City/add_city');
	}
	public function update_city() {
		return view('City/update_city');
	}
}

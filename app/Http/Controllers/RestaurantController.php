<?php

namespace App\Http\Controllers;

use App\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function __construct()
	{
		
	}
	
	public function index()
	{
		$model = Restaurant::all();
		
		return view('restaurant/index', compact('model'));
	}
	
	public function add()
	{
		return view('restaurant/create');
	}
	
	public function save(Request $request)
	{
		dd($request->all());
	}
}

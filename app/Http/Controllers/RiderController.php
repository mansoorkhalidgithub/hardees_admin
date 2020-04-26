<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RiderController extends Controller
{
    public function __construct()
	{
		
	}
	
	public function index()
	{
		return view('restaurant/index');
	}
}

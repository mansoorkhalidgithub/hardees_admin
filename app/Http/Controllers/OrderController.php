<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
	{
		
	}
	
	public function index()
	{
		return view('restaurant/index');
	}
}

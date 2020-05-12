<?php

namespace App\Http\Controllers;

use App\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct()
	{
		
	}
	
	public function index()
	{
		$model  = Auth::all();
		
		return view('restaurant/index', compact('model'));
	}
}

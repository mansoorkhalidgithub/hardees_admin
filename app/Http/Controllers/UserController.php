<?php

namespace App\Http\Controllers;

use App\Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
	{
		
	}
	
	public function index()
	{
		$model = Auth::all();
		
		return view('user/index', compact('model'));
	}
}

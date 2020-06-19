<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
	public function __construct()
	{
	}

	public function index()
	{
		$model = User::all();

		return view('customer.index', compact('model'));
	}

	public function add()
	{
		return view('customer.create');
	}
}

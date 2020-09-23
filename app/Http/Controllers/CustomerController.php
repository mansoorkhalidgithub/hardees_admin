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
		$model = User::role('customer')->get();
		$model->each->append('orderCount', 'rating');
		// dd($model->where('is_verified', 1));
		return view('customer.index', compact('model'));
	}

	public function add()
	{
		return view('customer.create');
	}
}

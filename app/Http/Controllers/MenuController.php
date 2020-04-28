<?php

namespace App\Http\Controllers;

use Auth;
use Helper;
use App\MenuItem;
use App\MenuCategory;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function __construct()
	{
		
	}
	
	public function index()
	{
		$model = MenuItem::all();
		
		return view('menu/index', compact('model'));
	}
	
	public function menuCategories()
	{
		$model = MenuCategory::all();
		
		return view('menu/menu-categories', compact('model'));
	}
	
	public function create()
	{
		return view('menu/menu-categories');
	}
	
	public function addCategory()
	{
		$model = MenuCategory::all();
		
		return view('menu/menu-categories', compact('model'));
	}
}

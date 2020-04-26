<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
	
	public function dashboard()
    {
        return view('dashboard');
    }
	
	public function message()
    {
        return view('home');
    }
	
	public function appSiders()
    {
        return view('home');
    }
	
	public function taxSetting()
    {
        return view('home');
    }
	
	public function manageCurrency()
    {
        return view('home');
    }
	
	public function requests()
    {
        return view('home');
    }
	
	public function notifications()
    {
        return view('home');
    }
	
	public function earnings()
    {
        return view('home');
    }
}

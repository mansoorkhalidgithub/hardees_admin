<?php

namespace App\Http\Controllers\Api;

use App\MenuItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HardeesApiController extends Controller
{
    public function __construct()
	{
		
	}
	
	public function menu(Request $request)
	{
		$menu = MenuItem::all();
		
		$response = [
            'status' => 1,
            'method' => $request->route()->getActionMethod(),
            'message' => 'Menu fetched successfully',
			'data' => [
				'menu' => $menu
			]
        ];

        return response()->json($response);
	}
}

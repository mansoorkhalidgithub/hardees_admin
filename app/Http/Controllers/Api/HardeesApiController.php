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
		$singleItems = MenuItem::all();
		$deals = MenuItem::all();
		
		$response = [
            'status' => 1,
            'method' => $request->route()->getActionMethod(),
            'message' => 'Menu fetched successfully',
			'data' => [
				'menu' => [
					'singleItems' => $singleItems,
					'deals' => $singleItems,
				]
			]
        ];

        return response()->json($response);
	}
}

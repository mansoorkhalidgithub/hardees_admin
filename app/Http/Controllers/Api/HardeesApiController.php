<?php

namespace App\Http\Controllers\Api;

use App\Deal;
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
		$deals = Deal::all();
		
		$response = [
            'status' => 1,
            'method' => $request->route()->getActionMethod(),
            'message' => 'Menu fetched successfully',
			'data' => [
				'menu' => [
					'singleItems' => $singleItems,
					'deals' => $deals,
				]
			]
        ];

        return response()->json($response);
	}
	
	public function createCustomDeal(Request $request)
	{
		$response = [
            'status' => 1,
            'method' => $request->route()->getActionMethod(),
            'message' => 'Custom deal work is pending'
        ];

        return response()->json($response);
	}
}

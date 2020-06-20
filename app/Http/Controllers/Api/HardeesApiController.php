<?php

namespace App\Http\Controllers\Api;

use App\Deal;
use App\MenuItem;
use App\MenuCategory;
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
	
	public function getCategories(Request $request)
	{
		$menuCategories = MenuCategory::all();
		
		$response = [
            'status' => 1,
            'method' => $request->route()->getActionMethod(),
            'message' => 'Get menu items by category ',
			'data' => [
				'menuCategories' => $menuCategories
			]
        ];

        return response()->json($response);
	}
	
	public function menuItems(Request $request)
	{
		$menuCategoryId = $request->menu_category_id;
		
		$itemsByCategory = MenuItem::where('menu_category_id', $menuCategoryId)->get();
		
		$response = [
            'status' => 1,
            'method' => $request->route()->getActionMethod(),
            'message' => 'Get menu items by category ',
			'data' => [
				'itemsByCategory' => $itemsByCategory
			]
        ];

        return response()->json($response);
	}
}

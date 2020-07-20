<?php

namespace App\Http\Controllers;

use App\User;
use App\Order;
use App\Cart;
use App\MenuCategory;
use App\MenuItem;
use App\Restaurant;
use Auth;
use Helper;
use Illuminate\Http\Request;
use Image;

class MenuController extends Controller {
	public function __construct() {

	}

	public function index() {
		$model = MenuItem::all();
		return view('menu/index', compact('model'));
	}

	public function menuCategories() {
		$model = MenuCategory::all();
		return view('menu/menu-categories', compact('model'));
	}

	public function create() {
		return view('menu/create-category');
	}
	public function editCategory($id) {
		$catgorey = MenuCategory::find($id);

		return view('menu/edit-category', ['catgorey' => $catgorey]);
	}

	public function editMenu($id) {
		$menuItem = MenuItem::find($id);
		$Categories = MenuCategory::all();
		$restaurants = Restaurant::all();
		return view('menu/edit-menu', compact(['restaurants', 'Categories'], 'menuItem'));
	}

	public function createMenuItem() {
		$Categories = MenuCategory::all();
		$restaurants = Restaurant::all();
		return view('menu/create-menu', compact(['restaurants', 'Categories']));
	}

	public function serializeAttr($val) {
		return serialize(array($val));
	}

	public function addMenuItems(Request $request) {

		$this->validateMenuData($request);

		$createdBy = Auth::user()->id;
		$add = new MenuItem();
		$add->menu_category_id = $request->menu_category_id;
		$add->created_by = $createdBy;
		$add->name = $request->name;
		$add->restaurant_id = $request->restaurant_id;
		$add->quantity = $request->quantity;
		$add->price = $request->price;
		$add->discount = $request->discount;
		$add->weight = $request->weight;
		$add->is_favourite = $request->is_favourite ? 1 : 0;
		$add->ingredients = $request->ingredients ? $this->serializeAttr($request->ingredients) : null;
		$add->status = $request->status;
		$imgPath = false;
		if ($request->has('itemImg')) {
			//dd(1);
			$image = $request->file('itemImg');
			$input['imagename'] = Helper::generateRandomString() . '.' . $image->getClientOriginalExtension();

			$destinationPath = public_path('/uploads/menu_items');
			if (!file_exists($destinationPath)) {
				mkdir($destinationPath, 0777, true);
			}
			$img = Image::make($image->getRealPath());
			$img->save($destinationPath . '/' . $input['imagename']);

			$imgPath = 'uploads/menu_items/' . $input['imagename'];

			$add->image = $imgPath;
		}
		$add->save();
		return redirect('menu')->with('message', 'Menue item added successfully');
	}

	public function updateMenuItem(Request $request) {
		$id = $request->menuItemId;
		$this->validateMenuEditData($request, $id);
		$createdBy = Auth::user()->id;
		$add = MenuItem::find($id);
		$add->menu_category_id = $request->menu_category_id;
		$add->created_by = $createdBy;
		$add->name = $request->name;
		$add->restaurant_id = $request->restaurant_id;
		$add->quantity = $request->quantity;
		$add->price = $request->price;
		$add->discount = $request->discount;
		$add->weight = $request->weight;
		$add->is_favourite = $request->is_favourite ? 1 : 0;
		$add->ingredients = $request->ingredients ? $this->serializeAttr($request->ingredients) : null;
		$add->status = $request->status;
		if ($request->has('itemImg')) {
			//dd(1);
			$image = $request->file('itemImg');
			$input['imagename'] = Helper::generateRandomString() . '.' . $image->getClientOriginalExtension();

			$destinationPath = public_path('/uploads/menu_items');
			if (!file_exists($destinationPath)) {
				mkdir($destinationPath, 0777, true);
			}
			$img = Image::make($image->getRealPath());
			$img->save($destinationPath . '/' . $input['imagename']);

			$imgPath = 'uploads/menu_items/' . $input['imagename'];
			$add->image = $imgPath;
		}
		$add->save();
		return redirect('menu')->with('message', 'Menue item updated successfully');
	}

	private function validateMenuEditData($request, $id) {
		$this->validate($request, [
			'name' => 'required|max:60|unique:menu_items,name,' . $id,
			'menu_category_id' => 'required|numeric',
			'restaurant_id' => 'required|numeric',
			'price' => 'required|numeric',
			'quantity' => 'required|numeric',
			'discount' => 'required|numeric',
			'weight' => 'required|numeric',
			'status' => 'required|numeric|max:1',
			// 'is_favourite'=>'required|numeric|max:3',
			'itemImg' => 'mimes:jpeg,jpg,png | max:1000',

		],
			[
				'menu_category_id.numeric' => 'Please Select Categorie',
				'restaurant_id.numeric' => 'Please Select Restaurants Branch',
			]);
	}

	private function validateMenuData($request) {
		$this->validate($request, [
			'name' => 'required|max:60|unique:menu_items,name',
			'menu_category_id' => 'required|numeric',
			'restaurant_id' => 'required|numeric',
			'price' => 'required|numeric',
			'quantity' => 'required|numeric',
			'discount' => 'required|numeric',
			'weight' => 'required|numeric',
			'status' => 'required|numeric|max:1',
			// 'is_favourite'=>'required|numeric|max:3',
			//'itemImg' => 'mimes:jpeg,jpg,png | max:1000',

		],
			[
				'menu_category_id.numeric' => 'Please Select Categorie',
				'restaurant_id.numeric' => 'Please Select Restaurants Branch',
			]);

	}
	public function show($id) {
		$model = MenuItem::find($id);
		return view('menu/show', compact('model'));
	}
	public function updateCategory(Request $request) {
		$this->validateInput($request);
		$catgorey = MenuCategory::find($request->categoryId);
		$catgorey->name = $request->name;
		$catgorey->save();
		return redirect('menu-categories')->with('message', 'Menue category updated successfully');
	}
	public function addCategory(Request $request) {
		$this->validateInput($request);
		$user = new MenuCategory;
		$user->name = $request->name;
		$user->save();
		return redirect('menu-categories')->with('message', 'Menue category added successfully');
	}
	private function validateInput($request) {
		$this->validate($request, [
			'name' => 'required|max:60|unique:menu_categories,name',
		]);

	}
	
	public function menuItems(Request $request)
	{
		$userId = Auth::user()->id;
		
		$cartItems = Cart::where('user_id', $userId)->pluck('item_id');
		
		$menuCategoryId = $request->menu_category_id;
		
		$itemsByCategory = MenuItem::where('menu_category_id', $menuCategoryId)->get();
		
		
		
		$html = '';
		foreach($itemsByCategory as $key => $item) 
		{
			$checked = '';
			if(in_array($item->id, $cartItems->all(), true))
			{
				$checked = 'checked';
			}
			
			$html .= '<div class="col-sm-2">
				<label class="category">
					<input '. $checked .' type="checkbox" id="'. $item->id .'" onchange="addToCart(this)" name="items[]" value="'. $item->id .'"/>
					<div>
						<p class="product_label"> '. $item->name .' </p><br>
						<div class="popup" onmouseover="myFunction('. $item->id .')" onmouseout="myFunctionClose('. $item->id .')"><img src="'. env('APP_URL') . $item->image .'"  class="product_image">
							<span class="popuptext" id="myPopup-'. $item->id .'">
								<small> <p class="p-2"> '. $item->ingredients .'</p> PKR '. $item->price .' </small>
							</span>
						</div>
					</div>
				</label>
				<div class="input-group input-number-group add-qty">
					<div class="input-group-button">
						<span onclick="removeQuantity(this.id)" id="'. $item->id .'" class="input-number-decrement bg-whitesmoke">-</span>
					</div>
					<input class="input-number" type="number" data_id="'. $item->id .'" id="quantity-'. $item->id .'" name="quantity" value="1" min="0" max="1000">
					<div class="input-group-button">
						<span onclick="addQuantity(this.id)" id="'. $item->id .'" class="input-number-increment bg-whitesmoke">+</span>
					</div>
				</div>
			</div>';
		}
		
		echo $html;
	}
}

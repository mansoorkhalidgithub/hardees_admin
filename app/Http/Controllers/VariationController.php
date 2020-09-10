<?php

namespace App\Http\Controllers;

use Auth;
use App\Side;
use App\Extra;
use App\Drink;
use App\Addon;
use App\Bucket;
use App\MenuItem;
use App\MenuCategory;
use App\Variation;
use App\ItemVariation;
use Illuminate\Http\Request;

class VariationController extends Controller
{

	public function create(Request $request)
	{
		$itemId = $request->id;
		$item = MenuItem::where('id', $itemId)->first();

		$variations = Variation::all();
		$drinks = Drink::all();
		$sides = Side::all();
		$extras = Extra::all();

		return view('variation/create', compact('variations', 'drinks', 'sides', 'extras', 'item'));
	}

	public function save(Request $request)
	{
		//dd($request->all());
		$variationDrinks = [];
		$variationSides = [];
		$variationExtras = [];

		$itemId = $request->item_id;

		$variationIds = $request->variation_id;
		$variationPrices = $request->price;
		$variationDrinks = $request->has('is_drink') ? $request->is_drink : $variationDrinks;
		$variationSides = $request->has('is_side') ? $request->is_side : $variationSides;
		$variationExtras = $request->has('is_extra') ? $request->is_extra : $variationExtras;

		foreach ($variationIds as $key => $variationId) {

			$data = [
				'menu_item_id' => $itemId,
				'variation_id' => $variationIds[$key],
				'price' => $variationPrices[$key],
				'is_drink' => array_key_exists($key, $variationDrinks) ? $variationDrinks[$key] : 0,
				'is_side' => array_key_exists($key, $variationSides) ? $variationDrinks[$key] : 0,
				'is_extra' => array_key_exists($key, $variationExtras) ? $variationExtras[$key] : 0
			];

			ItemVariation::create($data);
		}

		if($request->has('names'))
		{
			$names = $request->names;
			$prices = $request->prices;

			foreach($names as $keyOne => $name)
			{
				$dataOne = [
					'menu_item_id' => $itemId,
					'name' => $names[$keyOne],
					'price' => $prices[$keyOne],
				];

				Addon::create($dataOne);
			}
		}


		return redirect('menu');
	}

	public function variations(Request $request)
	{
		$itemId = $request->item_id;

		$model = ItemVariation::where('menu_item_id', $itemId)->get();

		$html = "<tbody>";
		foreach ($model as $ItemVariation) {
			$html .= '<tr id="' . $ItemVariation->variation_id . '">
				<td  id="' . $ItemVariation->variation_id . '" style="border-bottom:1px solid transparent;color:black"><input onclick="vItems(this)" id="' . $ItemVariation->variation_id . '" item-id="' . $itemId . '" type="radio" name="variation"> ' . $ItemVariation->variation->name . '</td>
				<td  id="' . $ItemVariation->variation_id . '" style="border-bottom:1px solid transparent;color:black; font-size: 12px">+ PKR ' . $ItemVariation->price . '</td>
			</tr>';
		}
		$html .= "<tbody>";

		echo $html;
	}
	
	public function dealVariations(Request $request)
	{
		$itemId = $request->item_id;

		$model = ItemVariation::where('menu_item_id', $itemId)->get();

		$html = '<table class="table" id="variations"><tbody>';
		foreach ($model as $ItemVariation) {
			$html .= '<tr id="' . $ItemVariation->variation_id . '">
				<td  id="' . $ItemVariation->variation_id . '" style="border-bottom:1px solid transparent;color:black"><input checked onclick="vItems(this)" id="' . $ItemVariation->variation_id . '" item-id="' . $itemId . '" type="radio" name="variation"> ' . $ItemVariation->variation->name . '</td>
				<td  id="' . $ItemVariation->variation_id . '" style="border-bottom:1px solid transparent;color:black; font-size: 12px">+ PKR ' . $ItemVariation->price . '</td>
			</tr>';
		}
		$html .= "<tbody></table>";
		
		$drinks = Drink::all();
		
		for($i = 1; $i < 4; $i++) :
		if (count($drinks) > 0) {
			$html .= '<h5 style="color:black; font-size: 16px">Choose your Drink ' . $i . '<span style="font-size: 12px; color:#7c888d; float: right; "> 1 REQUIRED</span></h5><br>';
			$html .= '<table class="table text-light" style="border-top:1px solid white;"><tbody>';
			foreach ($drinks as $drink) {
				$price = "";
				if ($drink->default !== 1) {
					$price = "+ PKR " . $drink->price;
				}

				$html .= '<tr>
					<td style="border-bottom:1px solid transparent;color:black"><input class="drinkClass" id="' . $drink->id . '" type="radio" name="drink_'. $i .'" value="' . $drink->id . '"> ' . $drink->name . '</td>
					<!--<td style="border-bottom:1px solid transparent;color:black; font-size: 12px">' . $price . '</td>-->
				</tr>';
			}
			$html .= '</tbody></table><hr><br>';
		}
		
		endfor;

		echo $html;
	}

	public function items(Request $request)
	{
		$variationId = $request->variation_id;
		$itemId = $request->item_id;

		$model = ItemVariation::where('variation_id', $variationId)->where('menu_item_id', $itemId)->first();

		$model->append('drinks', 'sides', 'extras');

		$html = '';

		if (count($model->drinks) > 0) {
			$html .= '<h5 style="color:black; font-size: 16px">Choose your Drink<span style="font-size: 12px; color:#7c888d; float: right; "> 1 REQUIRED</span></h5><br>';
			$html .= '<table class="table text-light" style="border-top:1px solid white;"><tbody>';
			foreach ($model->drinks as $drink) {
				$price = "";
				if ($drink->default !== 1) {
					$price = "+ PKR " . $drink->price;
				}

				$html .= '<tr>
					<td style="border-bottom:1px solid transparent;color:black"><input id="' . $drink->id . '" type="radio" name="drink" value="' . $drink->id . '"> ' . $drink->name . '</td>
					<td style="border-bottom:1px solid transparent;color:black; font-size: 12px">' . $price . '</td>
				</tr>';
			}
			$html .= '</tbody></table><hr><br>';
		}

		if (count($model->sides) > 0) {
			$html .= '<h5 style="color:black; font-size: 16px">Choose your Side <span style="font-size: 12px; color:#7c888d; float: right; "> 1 REQUIRED</span></h5><br>';
			$html .= '<table class="table text-light" style="border-top:1px solid white;"><tbody>';

			foreach ($model->sides as $side) {
				$price = "";
				if ($side->default !== 1) {
					$price = "+ PKR " . $side->price;
				}

				$html .= '<tr>
					<td style="border-bottom:1px solid transparent;color:black"><input id="' . $side->id . '" type="radio" name="side"> ' . $side->name . '</td>
					<td style="border-bottom:1px solid transparent;color:black; font-size: 12px">' . $price . '</td>
				</tr>';
			}
			$html .= '</tbody></table><hr><br>';
		}


		if (count($model->extras) > 0) {
			$html .= '<h5 style="color:black; font-size: 16px">Choose Extra <span style="font-size: 12px; color:#7c888d; float: right; "> 1 REQUIRED</span></h5><br>';
			$html .= '<table class="table text-light" style="border-top:1px solid white;"><tbody>';

			foreach ($model->extras as $extra) {
				$html .= '<tr">
						<td style="border-bottom:1px solid transparent;color:black"><input id="' . $extra->id . '" type="radio" name="extra"> ' . $extra->name . '</td>
						<td style="border-bottom:1px solid transparent;color:black; font-size: 12px">+ PKR ' . $extra->price . '</td>
					</tr>';
			}
			$html .= '</tbody></table><hr><br>';
		}

		$addons = Addon::all();

		if (count($addons) > 0) {

			$addons = [];

			$addons = Addon::where('menu_item_id', $itemId)->get();

			if(count($addons) > 0) {
				$addons = $addons;
			} else {
				$addons = Addon::all();
			}

			if(count($addons) > 0)
			{
				$html .= '<h5 style="color:black; font-size: 16px">Choose your Add Ons<span style="font-size: 12px; color:#7c888d; float: right; "> OPTIONAL</span></h5>';
				$html .= '<span style="color:black; font-size: 13px">Select up to 4 (Optional)</span><br>';
				$html .= '<table class="table text-light"><tbody>';

				foreach ($addons as $addon) {
					$price = "+ PKR " . $addon->price;

					$html .= '<tr>
							<td  style="border-bottom:1px solid transparent;color:black"><input id="' . $addon->id . '" type="checkbox" name="addon" value="' . $addon->id . '"> ' . $addon->name . ' </td>

							<td  style="border-bottom:1px solid transparent;color:black; font-size: 12px">' . $price . '</td>
						</tr>';
				}
				$html .= '</tbody></table><hr><br>';
			}

			echo $html;
		}
	}

	public function addToBucket(Request $request)
	{
		$userId = Auth::user()->id;

		$addons = "";
		if (!empty($request->addons) && count($request->addons) > 0) {
			$addons = serialize($request->addons);
		}
		$data = [
			'user_id' => $userId,
			'item_id' => $request->item_id,
			'variation_id' => $request->variation_id,
			'drink_id' => $request->drink_id,
			'side_id' => $request->side_id,
			'extra_id' => $request->extra_id,
			'quantity' => $request->quantity,
			'addons' => $addons,
		];

		$bucket = Bucket::create($data);

		$response = ['code' => 1];

		echo json_encode($response);
	}
	
	public function addDealToBucket(Request $request)
	{
		$userId = Auth::user()->id;
		
		$drinkIds  = [];
		
		$drink1 = $request->drink_1;
		$drink2 = $request->drink_2;
		$drink3 = $request->drink_3;
		
		array_push($drinkIds, $drink1);
		array_push($drinkIds, $drink2);
		array_push($drinkIds, $drink3);

		$data = [
			'user_id' => $userId,
			'item_id' => $request->item_id,
			'variation_id' => $request->variation_id,
			'quantity' => $request->quantity,
			'drinks' => serialize($drinkIds)
		];

		$bucket = Bucket::create($data);

		$response = ['code' => 1];

		echo json_encode($response);
	}
	
	public function manageDeal(Request $request)
	{
		$itemId = $request->id;
		$item = MenuItem::where('id', $itemId)->first();

		$variations = Variation::all();
		
		$menuCategories = MenuCategory::where('type', 'single_item')->get();
		
		$drinks = Drink::all();
		$sides = Side::all();
		$extras = Extra::all();

		return view('variation/create-deal', compact('menuCategories', 'drinks', 'sides', 'extras', 'item'));
	}
}

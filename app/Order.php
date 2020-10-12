<?php



namespace App;



use App\OrderStatus;

use Helper;

use Illuminate\Database\Eloquent\Model;



class Order extends Model

{

	// protected $with = ['orderItems'];



	protected $appends = ['order_reference', 'status_html'];



	protected $fillable = [

		'restaurant_id',

		'user_id',

		'delivery_charges',

		'discount',

		'tax',

		'sub_total',

		'total',

		'payment_method_id',

		'latitude',

		'longitude',

		'customer_address',

		'order_type_id',

		'menu',

		'region_id'

	];



	public function orderItems()

	{

		return $this->hasMany(OrderItem::class, 'order_id');
	}



	public function orderDeals()

	{

		return $this->hasMany(OrderDeal::class, 'order_id');
	}



	public function orderAddons()

	{

		return $this->hasMany(OrderAddon::class, 'order_id');
	}



	public function getorderItemsWithNameAttribute()

	{

		$data = OrderItem::where('order_id', $this->id)->get();

		$data->each->append(

			'Name'

		);

		return $data;
	}

	public function ordersAccepted()

	{



		return $this->hasOne(OrderStatus::class, 'id', 'status')->where('name', 'Accepted');
	}

	public function newOrders()

	{

		return $this->hasOne(OrderStatus::class, 'id', 'status')->where('name', 'Pending');
	}

	public function belongToUser()

	{

		return $this->belongsTo(User::class, 'user_id');
	}

	public function getOrdertypeAttribute()

	{

		$orderStatus = OrderType::find($this->order_type_id);

		if ($orderStatus) {

			return $orderStatus->type;
		}
	}

	public function getcustomerDataAttribute()

	{
		$data = [];
		if(!empty($this->user_id)){
			$model = User::findOrFail($this->user_id)->first();
			if(!empty($model)){
				$model->append(
					'orderAddress'
				);
				return $model;
			}
		}
		
		return $data;
	}

	public function getapproxTimeAttribute()

	{

		return 15;
	}

	public function getmenueItemNameAttribute()

	{

		$orderitems = OrderItem::where('order_id', $this->id)->select('menu_item_id')->first();

		$menueItem = MenuItem::where('id', $orderitems->menu_item_id)->select('name')->first();

		return $menueItem->name;
	}

	public function getriderAsignedAttribute()

	{

		$OrderAssigned = OrderAssigned::where('order_id', $this->id)->first();

		$data = (object) [];

		if ($OrderAssigned) {

			$data = User::where('id', $OrderAssigned->rider_id)->select(['first_name', 'last_name', 'phone_number'])->first();

			$data->append(

				'Rating'

			);
		}

		return $data;
	}

	public function getbookingNoAttribute()

	{

		return $this->id;
	}

	public function restaurant()

	{

		return $this->hasOne(Restaurant::class, 'id', 'restaurant_id');
	}



	public function customer()

	{

		return $this->hasOne(User::class, 'id', 'user_id');
	}



	public function orderAssigned()

	{

		return $this->hasOne(OrderAssigned::class, 'order_id', 'id')

			->where('status', 1);

		// ->orderBy('created_at', 'DESC');

	}



	public function getOrderReferenceAttribute()

	{

		return Helper::orderReference($this->id);
	}

	public function getorderStatusAttribute()

	{

		$orderStatus = OrderStatus::where('id', $this->status)->pluck('name');



		$statusName = $orderStatus[0];



		return $statusName;
	}

	public function getStatusHtmlAttribute()

	{

		if ($this->status) {

			$orderStatus = OrderStatus::where('id', $this->status)->first();

			if ($orderStatus)

				$html = '<span class="btn btn-success btn-sm">' . $orderStatus->name . '<span>';

			else

				$html = '<span class="btn btn-success btn-sm">' . 'No Status Found' . '<span>';

			// return $html;

		} else {

			$html = '<span class="btn btn-success btn-sm">' . 'No Status Found' . '<span>';



			// return $html;

		}

		return $html;
	}

	// By Qadeer

	public function getDistanceAttribute()

	{

		$restaurant = Restaurant::find($this->restaurant_id);

		return MasterModel::distance($restaurant->latitude, $restaurant->longitude, $this->latitude, $this->longitude);
	}

	public function getTimeAttribute()

	{

		return date_diff($this->created_at, $this->updated_at)->format('%H:%i:%s');
	}





	public function getRatingAttribute()

	{

		$data = 0;

		$rating = Review::where('user_id', $this->user_id)->pluck('rating')->first();

		if ($rating)

			return $rating;

		else return $data;
	}



	public function getCustomernameAttribute()

	{

		$user = User::where('id', $this->user_id)->first();

		return $user->first_name . " " . $user->last_name;
	}



	public function getItemsAttribute()

	{

		$menu_item_ids = OrderItem::where('order_id', $this->id)->pluck('menu_item_id');

		$menu_items = MenuItem::whereIn('id', $menu_item_ids->all())->pluck('name');

		return $menu_items;
	}

	public function getOrderItemsAttribute()
	{
		$data = [];
		$model = OrderVariation::where('order_id', $this->id)->get();
		// return array();
		if (!empty($model)) :
			foreach ($model as $key => $items) {
				$item = $items->item_id ?? $items->deal_id;
				$menu_item = MenuItem::find($item);
				$variation = Variation::find($items->variation_id) ?? '';
				$menu_items = (!empty($variation)) ? $menu_item->name . '(' . $variation->name . ')' : $menu_item->name;
				$price = (!empty($variation)) ? ItemVariation::where('menu_item_id', $item)->first()->price
					: DealVariation::where('menu_item_id', $item)->first()->price ;
				$quantity = $items->quantity;
				
				if (!empty($items->deal_drinks)) {
					$drink_ids = unserialize($items->deal_drinks);
					$drink = Drink::whereIn('id', $drink_ids)->get();
					$deal_drinks = $drink;
				} else {
					
						$deal_drinks = array();
				}
				if (!empty($items->drink_id)) {
						$drink = Drink::where('id', $items->drink_id)->first();
						$drinks = $drink;
					} else {
						$drinks= (object)array();
					}
				if (!empty($items->side_id)) {
					$side = Side::where('id', $items->side_id)->first();
					$sides = $side;
				} else {
					$sides = (object)array();
				}
				if (!empty($items->extra_id)) {
					$extra = Extra::where('id', $items->extra_id)->first();
					$extras = $extra;
				} else {
					$extras = (object)array();
				}

				// $bucket->each->append('total', 'addon', 'dealDrink','item','drink','extra','side');

				if (!empty($items->addons)) {
					$addon_ids = unserialize($items->addons);
					$addons = Addon::whereIn('id', $addon_ids)->select('name', 'price')->get();
				} else {
					$addons = array();
				}
				$data[] = [
					'name' => $menu_items,
					'price' => $price,
					'quantity' => $quantity,
					'sides' => $sides,
					'dealDrink'=> $deal_drinks,
					'drinks' => $drinks,
					'extras' => $extras,
					'addons' => $addons
				];
			}
		endif;
		return $data;
	}



	public function paymentType()

	{



		return $this->hasOne(PaymentMethod::class, 'id', 'payment_method_id');
	}

	public function getRiderNameAttribute()

	{

		$rider = '';

		$model = OrderAssigned::where('order_id', $this->id)->first();

		if (!empty($model)) {

			// return $model->rider_id;

			$model = User::find($model->rider_id);

			if ($model)

				return $model->name;
		} else return $rider;
	}



	public function type()

	{

		return $this->hasOne(OrderType::class, 'id', 'order_type_id');
	}

	// End By Qadeer



	public function orderVariations()

	{

		return $this->hasMany(OrderVariation::class, 'order_id');
	}
}

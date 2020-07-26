<?php

namespace App\Http\Controllers;

use App\User;
use App\Deal;
use App\Addon;
use App\MenuItem;
use App\DealCategory;
use App\MenuCategory;
use App\AddonCategory;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$itemCategories = MenuCategory::all();
		$items = MenuItem::where('menu_category_id', $itemCategories[0]->id)->get();
		$dealCategories = DealCategory::where('status', 1)->get();
		$deals = Deal::where('deal_category_id', $dealCategories[0]->id)->where('status', 1)->get();
		$addonCategories = AddonCategory::all();
		$addons = Addon::all();
		
        return view('order.new_booking_form', compact('itemCategories', 'items', 'dealCategories', 'deals', 'addonCategories', 'addons'));
    }
	
	public function save(Request $request)
	{
		dd($request->all());
	}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Delivery/trips');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getCustomer(Request $request)
    {
        $output = '';
        $data = [];
        if (isset($_REQUEST["search"])) {
            $customers = User::role('user')->where('first_name', 'like', '%' . $request->search . '%')
                ->orWhere('last_name', 'like', '%' . $request->search . '%')
                ->orWhere('username', 'like', '%' . $request->search . '%')
                ->orWhere('phone_number', 'like', '%' . $request->search . '%')
                ->get();
            if (count($customers) > 0) {
                foreach ($customers as $key => $customer) {
                    $data = [
                        'phone_number' => $customer["phone_number"],
                        'first_name' => $customer["first_name"],
                        'last_name' => $customer["last_name"],
                        'username' => $customer["username"],
                        'email' => $customer["email"]
                    ];

                    // $data[$customer["phone_number"]] = $customer["first_name"] . "|" . $customer["last_name"] . "|" . $customer["username"] . "|" . $customer["phone_number"];
                }
            } else {
                //$output .= '<li>Country Not Found</li>';  
            }
        }

        echo json_encode($data);
    }
}

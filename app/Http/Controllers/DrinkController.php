<?php

namespace App\Http\Controllers;

use App\Drink;
use App\Restaurant;
use Illuminate\Http\Request;

class DrinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $drinks = Drink::all();
        return view('drink.index', compact('drinks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $restaurants = Restaurant::all();
        //dd($restaurants);
        return view('drink.create', compact('restaurants'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'restaurant' => 'required|numeric',
        ]);

        $drink = new Drink;
        $drink->name = $request->name;
        $drink->price = $request->price;
        $drink->default = $request->default;
        $drink->restaurant_id = $request->restaurant;
        $drink->quantity = $request->quantity;
        $drink->active = $request->active;
        $drink->web_status = 1;
        $drink->save();

        return redirect('drink')->with('message', 'Drink added successfully');
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
        $drink = Drink::where('id',$id)->first();
        $restaurants = Restaurant::all();
        return view('drink.edit', compact('drink','restaurants'));
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
        $validatedData = $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'restaurant' => 'required|numeric',
        ]);

        $drink = Drink::find($id);
        $drink->name = $request->name;
        $drink->price = $request->price;
        $drink->default = $request->default;
        $drink->restaurant_id = $request->restaurant;
        $drink->quantity = $request->quantity;
        $drink->active = $request->active;
        $drink->web_status = 1;
        $drink->save();

        return redirect('drink')->with('message', 'Drink updated successfully');
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
}

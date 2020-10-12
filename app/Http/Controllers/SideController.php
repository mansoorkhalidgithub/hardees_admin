<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Side;
use App\Restaurant;

class SideController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sides = Side::all();
        return view('side.index', compact('sides'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $restaurants = Restaurant::all();
        return view('side.create', compact('restaurants'));
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

        $side = new Side;
        $side->name = $request->name;
        $side->price = $request->price;
        $side->default = $request->default;
        $side->restaurant_id = $request->restaurant;
        $side->quantity = $request->quantity;
        $side->active = $request->active;
        $side->web_status = 1;
        $side->save();

        return redirect('side')->with('message', 'Side added successfully');
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
        $side = Side::where('id',$id)->first();
        $restaurants = Restaurant::all();
        return view('side.edit', compact('side','restaurants'));
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

        $side = Side::find($id);
        $side->name = $request->name;
        $side->price = $request->price;
        $side->default = $request->default;
        $side->restaurant_id = $request->restaurant;
        $side->quantity = $request->quantity;
        $side->active = $request->active;
        $side->web_status = 1;
        $side->save();

        return redirect('side')->with('message', 'Side updated successfully');
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

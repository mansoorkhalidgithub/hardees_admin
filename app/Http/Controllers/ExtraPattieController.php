<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Extra;
use App\Restaurant;

class ExtraPattieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $extras = Extra::all();
        return view('extra_pattie.index', compact('extras'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $restaurants = Restaurant::all();
        return view('extra_pattie.create', compact('restaurants'));
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

        $extra = new Extra;
        $extra->name = $request->name;
        $extra->price = $request->price;
        $extra->restaurant_id = $request->restaurant;
        $extra->quantity = $request->quantity;
        $extra->active = $request->active;
        $extra->save();

        return redirect('pattie')->with('message', 'Extra Pattie added successfully');
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
        $extra = Extra::where('id',$id)->first();
        $restaurants = Restaurant::all();
        return view('extra_pattie.edit', compact('extra','restaurants'));
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

        $extra = Extra::find($id);
        $extra->name = $request->name;
        $extra->price = $request->price;
        $extra->restaurant_id = $request->restaurant;
        $extra->quantity = $request->quantity;
        $extra->active = $request->active;
        $extra->save();

        return redirect('pattie')->with('message', 'Extra Pattie updated successfully');
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

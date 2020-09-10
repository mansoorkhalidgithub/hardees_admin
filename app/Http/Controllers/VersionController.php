<?php

namespace App\Http\Controllers;

use App\Version;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class VersionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = Version::all();
        return view('version.index', compact('model'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\Version  $version
     * @return \Illuminate\Http\Response
     */
    public function show(Version $version)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Version  $version
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = Version::find($id);
        return view('version.edit', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Version  $version
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data = $request->all();
        $model = Version::find($request->id);
        $model->update($data);

        return Redirect::route('version.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Version  $version
     * @return \Illuminate\Http\Response
     */
    public function destroy(Version $version)
    {
        //
    }
}

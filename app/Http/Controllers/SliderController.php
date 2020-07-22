<?php

namespace App\Http\Controllers;

use App\Slider;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use App\Http\Requests\SliderRequest;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Session;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = Slider::all();
        return view('appslider.index', compact('model'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('appslider.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SliderRequest $request)
    {
        $data = $request->all();
        $data['created_by'] = Auth::user()->id;
        if ($request->has('slider')) {
            $image = $request->file('slider');
            $input['imagename'] = Helper::generateRandomString() . '.' . $image->getClientOriginalExtension();

            $destinationPath = public_path('/uploads/slider');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            $img = Image::make($image->getRealPath());
            $img->save($destinationPath . '/' . $input['imagename']);

            $sliderPath = 'uploads/slider/' . $input['imagename'];

            $data['image'] = $sliderPath;
        }
        $appslider = Slider::create($data);

        Session::flash('success', 'New App Slider created successfully');

        return redirect('sliders');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model = $this->findModel($id);
        return view('appslider.show', compact('model'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = $this->findModel($id);
        return view('appslider.edit', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $slider = $this->findModel($request->id);
        $data = $request->all();
        $data['created_by'] = Auth::user()->id;
        if ($request->has('slider')) {
            if (!empty($slider->slider_img)) {
                $sliderImage = public_path($slider->slider_img); // get previous image from folder
                if (file_exists($sliderImage)) { // unlink or remove previous image from folder
                    unlink($sliderImage);
                }
            }
            $image = $request->file('slider');
            $input['imagename'] = Helper::generateRandomString() . '.' . $image->getClientOriginalExtension();

            $destinationPath = public_path('/uploads/slider');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            $img = Image::make($image->getRealPath());
            $img->save($destinationPath . '/' . $input['imagename']);

            $sliderPath = 'uploads/slider/' . $input['imagename'];

            $data['image'] = $sliderPath;
        }
        $slider->update($data);

        Session::flash('success', 'App Slider Updated successfully');

        return redirect('sliders');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $slider = $this->findModel($request->id);
        $slider->delete();
        return redirect()->route('sliders');
    }

    protected function findModel($id)
    {
        return Slider::find($id);
    }
}

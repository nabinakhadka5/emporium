<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{

    protected $slider= null;
    public function __construct(Slider $slider){
        $this->slider = $slider;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_list = $this->slider->get();
        return view('admin.slider.index')->with('data_list',$data_list);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rule = $this->slider->getRules();
        $request->validate($rule);
        $data = $request->except('image');
        $data['added_by'] = $request->user()->id;
        if($request->image){
            $image_name = uploadImage($request->image,'slider','500x300');
        }
        if($image_name){
            $data['image'] = $image_name;
        }
        $this->slider->create($data);
        return redirect()->route('slider.index');

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
        $this->slider = $this->slider->find($id);
        return view('admin.slider.create')->with('data',$this->slider);
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
        $this->slider = $this->slider->find($id);
        $rule =$this->slider->getRules('update');
        $request->validate($rule);
        $data = $request->except('image');

        if($request->image){
            $image_name = uploadImage($request->image,'slider','500x300');
            if($image_name){
                $data['image'] = $image_name;
                if($this->slider->image!= ''){
                    deleteImage($this->slider->image,'slider');
                };
            }
        }
        $update = $this->slider->update($data);
        if($update){
            request()->session()->flash('success','Product has been updated');
        }else {
            request()->session()->flash('error','Product has not Been updated');

        }
        return redirect()->route('slider.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = $this->slider->find($id);
        $image = $data->image;
        $status = $data->delete();
        if($status){
            deleteImage($image,'slider');
            request()->session()->flash('success','Product has been deleted');
        }else {
            request()->session()->flash('error','Product has not Been deleted');

        }
        return redirect()->route('slider.index');
    }
}

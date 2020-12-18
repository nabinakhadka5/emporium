<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    protected $category= null;
    public function __construct(Category $category){
        $this->category = $category;
    }


    public function getAllChild(Request $request){
        $this->category = $this->category->getAllChildren($request->cat_id);
        if($this->category->count() > 0){
            return response()->json(['data'=>$this->category,'status'=>true]);
        } else {
            return response()->json(['data'=>null,'status'=>false]);

        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_list = $this->category->with(['parent_info','child_info'])->where('parent_id',null)->paginate();
        // dd($data_list);
        return view('admin.category.index')->with('data_list',$data_list);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parent_cats = $this->category->getAllParent();
        // dd($parent_cats);
        return view('admin.category.category')->with('parent_cats',$parent_cats);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rule = $this->category->getRules();
        $request->validate($rule);
        $data = $request->except('image');
        $data['slug'] = $this->category->getSlug($request->title);
        $data['added_by'] = $request->user()->id;
        if($request->image){
            $image_name = uploadImage($request->image,'category','500x300');
        }
        if($image_name){
            $data['image'] = $image_name;
        }
        $this->category->create($data);
        return redirect()->route('category.index');
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
        $this->category = $this->category->find($id);
        $parent_cats = $this->category->getAllParent();
        return view('admin.category.category')
        ->with('parent_cats',$parent_cats)
        ->with('data',$this->category);
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
        $this->category = $this->category->find($id);
        $rule =$this->category->getRules('update');
        $request->validate($rule);
        $data = $request->except('image');

        if($request->image){
            $image_name = uploadImage($request->image,'category','500x300');
            if($image_name){
                $data['image'] = $image_name;
                if($this->category->image!= ''){
                    deleteImage($this->category->image,'category');
                };
            }
        }
        $update = $this->category->update($data);
        if($update){
            request()->session()->flash('success','Product has been updated');
        }else {
            request()->session()->flash('error','Product has not Been updated');

        }
        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = $this->category->find($id);
        $image = $data->image;
        $status = $data->delete();
        if($status){
            deleteImage($image,'category');
            request()->session()->flash('success','Product has been deleted');
        }else {
            request()->session()->flash('error','Product has not Been deleted');

        }
        return redirect()->route('category.index');
    }
}

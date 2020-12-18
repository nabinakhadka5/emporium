<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\User;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    protected $product= null;
    protected $user= null;
    protected $category= null;
    public function __construct(Product $product,Category $category, User $user){
        $this->product = $product;
        $this->category = $category;
        $this->user = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->product = $this->product->with(['cat_info','sub_cat_info','seller_info'])->orderBy('id','DESC')->paginate();
        return view('admin.product.index')->with('data_list',$this->product);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = $this->category->getAllParent();
        $data_list = $this->user->where('role','seller')->pluck('name','id');
        return view('admin.product.form')->with('category',$category)->with('seller_list',$data_list);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = $this->product->getAllRules();
        $request->validate($rules);
        $data = $request->except(['image','related_images']);
        $data['added_by'] = $request->user()->id;
        $data['slug'] = $this->product->getSlug($request->title);
        $data['actual_price'] = $request->pricce - (($request->price *$request->discount)/100);

        // seller ko field ma chae
        // except - data->status = inactive and data->seller_id = user()->id
        if($request->image){
            $image_name = uploadImage($request->image, 'product','200x200');
            if($image_name){
                $data['image'] = $image_name;
            }
        }
         $status = $this->product->fill($data);
         $status = $this->product->save();

        // $status = $this->product->create($data);
        if($status){
            if($request->related_images){
                foreach($request->related_images as $rel_image){
                    $img_name = uploadImage($rel_image , 'product','200x200');
                    if($img_name){
                        $temp_data = array(
                            'product_id' => $this->product->id,
                            'image_name' => $img_name
                        );
                        $product_image = new ProductImage();
                        $product_image->fill($temp_data);
                        $product_image->save();
                    }
                }
            }
             request()->session()->flash('success','Products Stored Successfully');
        } else {
            request()->session()->flash('error','Products Stored Successfully');

        }
        return redirect()->route('product.index');
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
        $category = $this->category->getAllParent();
        $seller_list = $this->user->where('role','seller')->pluck('name','id');
        $this->product = $this->product->findOrFail($id);
        return view('admin.product.form')
                    ->with('data',$this->product)
                    ->with('seller_list',$seller_list)
                    ->with('category',$category);
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
        $this->product = $this->product->with('images')->find($id);
        $rules = $this->product->getAllRules('update');

        $request->validate($rules);

        $data= $request->except(['images','related_images']);

        $data['actual_price'] = $request->pricce - (($request->price *$request->discount)/100);

        if($request->image) {
            $image_name = uploadImage($request->image, 'product','200x200');
            $data['image'] = $image_name;
            deleteImage($this->product->image,'product');
        }

        $status = $this->product->update($data);
        if($status) {
            if(isset($request->del_image)){
                foreach($request->del_image as $del_images){
                    $img_prod = new ProductImage();
                    $img_prod = $img_prod->where('image_name',$del_images)->first();
                    if($img_prod){
                        $img_prod->delete();
                        deleteImage($del_images, 'product');
                    }
                }
            }

            if($request->related_images){
                foreach($request->related_images as $rel_img){
                    $img_name = uploadImage($rel_img, 'product','200x200');
                    $temp_data = array(
                        'product_id' => $this->product->id,
                        'image_name' => $img_name
                    );
                    $product_image = new ProductImage();
                    $product_image->fill($temp_data);
                    $product_image->save();
                }
            }
            request()->session()->flash('success','Data updated Successfully');
        } else {
            request()->session()->flash('error','Data couldnot be updated');
        }
         return redirect()->route('product.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->product = $this->product->with('images')->find($id);
        $cover_image = $this->product ->image;
        $images = $this->product->images;
        $status = $this->product ->delete();
        if($status){
            if($cover_image){
                deleteImage($cover_image, 'product');
            }
            if($images->count() > 0 ){
                foreach($images as $product_image){
                   deleteImage($product_image->image_name, 'product');
                }
            }
            request()->session()->flash('success','Data Deleted Successfully');
        } else {
            request()->session()->flash('error','Data couldnot be deleted');
        }
         return redirect()->route('product.index');

    }
}

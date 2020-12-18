<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    protected $fillable = ['title','summary','description','cat_id','sub_cat_id','added_by','slug','price','discount','actual_price','image','brand','is_featured','seller_id','status'];

    public function getAllRules($act = 'add'){
        $rules = array(
        'title' => 'required|string|max:150',
        'summary' => 'required|string|max:700',
        'description' => 'nullable|string|max:1000',
        'price' => 'required|numeric|min:100',
        'discount' => 'nullable|numeric|max:90',
        'cat_id' => 'required|exists:categories,id',
        'sub_cat_id' => 'nullable|exists:categories,id',
        'is_featured' => 'sometimes|in:1',
        'seller_id' => 'nullable|exists:users,id',
        'image' => 'required|image',
        'related_images.*' => 'sometimes|image',
        'brand' => 'nullable|string',
        'status' => 'required|in:active,inactive,out_of_stock',
        );

        if($act!= 'add'){
            $rules['image'] = 'sometimes|image';
        }
        return $rules;
    }

    public function getSlug($str){
        $slug = Str::slug($str);
        if($this->where('slug',$slug)->count() > 0){
            $slug .=date('Ymdhis').rand(0,999);
        }
        return $slug;
    }

    public function cat_info(){
        return $this->hasOne('App\Models\Category','id','cat_id');
    }

    public function sub_cat_info(){
        return $this->hasOne('App\Models\Category','id','sub_cat_id');
    }

    public function seller_info(){
        return $this->hasOne('App\User','id','seller_id');
    }

    public function images(){
        return $this->hasMany('App\Models\ProductImage','product_id','id');
    }
}

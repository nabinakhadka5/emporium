<?php

namespace App\Models;
use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['title','image','summary','slug','parent_id','status','added_by'];

    public function getAllChildren($cat_id){
        return $this->where('parent_id', $cat_id)->pluck('title','id');
    }


    public function getSlug($str){
        $slug = Str::slug($str);
        if($this->where('slug',$slug)->count() > 0){
            $slug .= date('Ymdhis').rand(0,999);
        }
        return $slug;
    }


    public function getRules($act = 'add'){
        $rules = array(
        'title' => 'required|string|unique:categories,title',
        'summary' => 'nullable|string',
        'image' => 'sometimes',
        'status' => 'required|in:active,inactive',
        'parent_id' => 'nullable|exists:categories,id'
        );
        if($act == 'update'){
            $rules['title'] = 'required|string';
        }
        return $rules;
    }



    public function getAllParent(){
    $data = $this->where('parent_id', NULL)->pluck('title','id');
    return $data;
    }

    public function child_info(){
        return $this->hasMany('App\Models\Category', 'parent_id','id');
    }

    public function parent_info(){
        return $this->hasOne('App\Models\Category','id','parent_id');
    }


}

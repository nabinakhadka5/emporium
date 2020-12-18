<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $fillable = ['title','link','image','status','added_by'];

    public function getRules($act = 'add'){
        $array = array(
            'title'=>'required|string',
            'link' => 'required|url',
            'image' => 'required|image',
            'status' => 'required|in:active,inactive',
            'added_by' => 'nullable|exists:users',
        );
        if($act!='add'){
            $array['image'] ='sometimes';
        }
        return $array;
    }
}

<?php

function deleteImage($image, $dir){
    if($image){
        $path = public_path().'/uploads/'.$dir;
        if($image!=null && file_exists($path.'/'.$image)){
            unlink($path.'/'.$image);
            if(file_exists($path.'/'.'/Thumb-'.$image)){
                unlink($path.'/Thumb-'.$image);
            }
            return true;
        } else{
            return false;
        }
    } else{
        return false;
    }
}

function imageUrl($image,$dir){
    if($image!=null && file_exists(public_path().'/uploads/'.$dir.'/Thumb-'.$image)){
        $url = asset('uploads/'.$dir.'/Thumb-'.$image);
    } elseif ($image!==null && file_exists(public_path().'/uploads/'.$dir.'/'.$image)){
        $url = asset('uploads/'.$dir.'/'.$image);
    } else {
        $url = null;
    }
    return $url;
}

function uploadImage($file, $dir,$thumb=null){ //obj,string,200x200

    $path =  public_path().'/uploads/'.$dir;
    if(!File::exists($path)){
        File::makeDirectory($path,0777,true,true);
    }

    $file_name = ucfirst($dir).'-'.date('ymdhis').rand(0,999).'.'.$file->getClientOriginalExtension();

    $status = $file->move($path,$file_name);

    if($status){
        if($thumb){
            list($width,$height) = explode('x',$thumb);
            Image::make($path.'/'.$file_name)->resize($width,$height,function($constraints){
                return $constraints->aspectRatio();
            })->save($path.'/Thumb-'.$file_name);
        }
        return $file_name;
     } else {
         return false;
     }


}



<?php

namespace App\Http\Controllers\Front;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FrontendController extends Controller
{
    public function homePage(){
        return view('home.index');
    }
}

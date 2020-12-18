<?php

namespace App\Http\Controllers\Front;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomePageController extends Controller
{
    public $slider =null;

    public function __construct(Slider $slider){
        $this->slider = $slider;
    }

    public function index(){

    }
}

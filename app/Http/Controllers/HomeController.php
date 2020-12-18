<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // return view('layouts.admin');
        return redirect()->route(request()->user()->role);
    }

    public function user(){
        return view('admin.dashboard');
    }

    public function customer(){
        return view('home');
    }

    public function seller(){
        return view('home');
    }
}

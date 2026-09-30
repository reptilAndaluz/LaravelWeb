<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
<<<<<<< HEAD
use App\Http\Controllers\MainController;

class MainController extends Controller
{
    function index(){
        return view('index');
    }
}
=======

class MainController extends Controller
{
    function about() {
        return view('about');
    }

    /*function aboutMetodo() {
        return view('about');
    }*/

    function index() {
        return view('index');
    }
}
>>>>>>> master

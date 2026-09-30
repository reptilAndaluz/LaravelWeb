<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Http\Request;

class AboutController extends Controller
{

    public function index()
    {


        return view('frontend.about')->with('about',Page::where('name->en','About US')->first());
    }


}

<?php

namespace App\Http\Controllers;

use App\Page;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('frontend.contact')->with('contact',Page::where('name->en','CONTACT US')->first());
    }
}

<?php

namespace App\Http\Controllers;


use App\Page;
use App\Section;
use App\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function homePage($lang)
    {

        return view('frontend.index')->with('sections',Section::where('page_id',1)->get())
            ->with('sliders',Slider::where('page_id',1)->get());

    }

    public function customPage($lang,$pageSlug)
    {
        $page = Page::where('slug',$pageSlug)->first();

        return view('frontend.about')->with('page',$page)
            ->with('sliders',Slider::where('page_id',$page->id)->get())
        ->with('sections',Section::where('page_id',$page->id)->get());
    }

}

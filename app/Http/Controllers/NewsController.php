<?php

namespace App\Http\Controllers;

use App\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        return view('frontend.news')->with('news',News::with('user')->paginate(1));
    }
    public function show($lang,News $news)
    {
        return view('frontend.single_news')->with('new',$news);
    }
    function fetchDataByAjax(Request $request)
    {
        if ($request->ajax()) {
            $sort_by = $request->get('sortby');
            $sort_type = $request->get('sorttype');
            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);
            $news = News::where("title->en", 'like', '%' . $query . '%')
                ->orwhere('title->ar', 'like', '%' . $query . '%')
                ->orderBy($sort_by, $sort_type)
                ->paginate(10);
            return view('backend.news.fetch-Data-By-Ajax', compact('news'))->render();
        }
    }

}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNewsRequest;
use App\Http\Requests\updateNewsRequest;
use App\News;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {

        return view('backend.news.index')->with('news',News::paginate(10));
    }
    public function create()
    {
        return view('backend.news.form');
    }
    public function store(StoreNewsRequest $request)
    {

        $data = $request->only(['title','small_description','content']) ;
        $banner = $request->banner->store('/new','public');
        $image = $request->image->store('/new','public');
        $data = array_merge($data , [
            'banner'=>$banner,
            'image'=>$image,
            'user_id'=>Auth()->user()->id
        ]);
        News::create($data);
        switch($request->submitbutton)
        {
            case 'save':
                return redirect()->back();
                break;
            case 'save-draft':
                return redirect()->route('blog.index');
                break;
        }
    }
    public function Edit(News $blog)
    {
        return view('backend.news.form')->with('blog',$blog);
    }
    public function update(updateNewsRequest $request , News $blog)
    {
        if($request->has('banner'))
        {
            if(file_exists('storage/'.$blog->banner))
                unlink('storage/'.$blog->banner);
            $banner = $request->banner->store('/new','public');
        }
        else
            $banner = $blog->banner ;
        if($request->has('image'))
        {

            if(file_exists('storage/'.$blog->image) && $blog->image)
                unlink('storage/'.$blog->image);
            $image = $request->image->store('/new','public');
        }
        else
            $image = $blog->image ;


        $blog->update(array_merge($request->only(['title','small_description','content']) ,[
            'banner'=>$banner,
            'image'=>$image
        ] ));


        switch($request->submitbutton)
        {
            case 'save':
                return redirect()->back();
                break;
            case 'save-draft':
                return redirect()->route('blog.index');
                break;
        }
    }
    public function destroy(News $blog)
    {
        if(file_exists('storage/'.$blog->banner))
            unlink('storage/'.$blog->banner);
        if(file_exists('storage/'.$blog->image))
            unlink('storage/'.$blog->image);
        $blog->delete();
        return redirect()->back();

    }
}

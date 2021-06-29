<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePageRequest;
use App\Http\Requests\UpdatePageRequest;
use App\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class PageController extends Controller
{
    public function index()
    {
        $test = Page::where("name->en", 'test')->get();
        $pages = Page::paginate(10);
        return view('backend.pages.index' , compact('pages'));
    }

    function fetchDataByAjax(Request $request)
    {
        if ($request->ajax()) {
            $sort_by = $request->get('sortby');
            $sort_type = $request->get('sorttype');
            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);
            $pages = Page::where("name->en", 'like', '%' . $query . '%')
                ->orwhere("name->ar", 'like', '%' . $query . '%')
                ->orwhere('content', 'like', '%' . $query . '%')
                ->orderBy($sort_by, $sort_type)
                ->paginate(10);
            return view('backend.pages.fetch-Data-By-Ajax', compact('pages'))->render();
        }
    }

    public function selectItem(Request $request)
    {
        $search = $request->get('search');
        $data = Page::select(['id', "name"])->where('name', 'like', '%' . $search . '%')->orderBy('id')->paginate(5);
        return response()->json(['items' => $data->toArray()['data'], 'pagination' => $data->nextPageUrl() ? true : false]);
    }

    public function create()
    {
        return view('backend.pages.form');
    }

    public function store(StorePageRequest $request)
    {


        $page = new Page();

        $page->name = $request->name;
        $page->content = $request['content'];
        $page->page_id = $request->page_id;
        $page->dropdown = $request->dropdown;
        $page->status = $request->status;
        $page->sort = $request->sort;
        $page->position = $request->position;
        $page->slug = Str::slug($request->name['en'] , '-');
        if (request()->hasFile('image')) {
            $image = $request->file('image');
            $fileName = time() .$image->getClientOriginalName();
            $img = Image::make($image->getRealPath());
            $img->resize(1024, 539);
            $img->stream();
            $page->image = $fileName;
            Storage::disk('local')->put('public/pages' . '/' . $fileName, $img, 'public');
        }
        if (request()->hasFile('banner')) {
            $image = $request->file('banner');
            $fileName = time() .$image->getClientOriginalName();
            $img = Image::make($image->getRealPath());
            $img->resize(1024, 539);
            $img->stream();
            $page->banner = $fileName;
            Storage::disk('local')->put('public/pages' . '/' . $fileName, $img, 'public');
        }
        $page->save();
        app('App\Http\Controllers\Activitiescontroller')->store(auth()->user()->id,'Create','Page',$page->id);
        Session()->flash('success' , 'Page Created Successfully');
        switch($request->submitbutton)
        {
            case 'save':
                return redirect()->back();
                break;
            case 'save-draft':
                return redirect()->route('pages.index');
                break;
        }
    }

    public function edit($id)
    {
        $page = Page::findOrFail($id);
        return view('backend.pages.form' , compact('page'));
    }

    public function update(UpdatePageRequest $request, $id)
    {
        $page = Page::findOrFail($id);
        $page->slug = Str::slug($request->name['en'] , '-');
        $page->name = $request->name;
        $page->content = $request['content'];
        $page->page_id = $request->page_id;
        $page->dropdown = $request->dropdown;
        $page->sort = $request->sort;
        $page->status = $request->status;
        $page->position = $request->position;
        if ($request->banner !== null) {
            Storage::disk('public')->delete('pages/'.$page->banner);
        }
        if ($request->image !== null) {
            Storage::disk('public')->delete('pages/'.$page->image);
        }
        if (request()->hasFile('banner')) {
            $image      = $request->file('banner');
            $fileName   = time() .$image->getClientOriginalName();

            $img = Image::make($image->getRealPath());
            $img->resize(1920, 552);
            $img->stream();
            $page->banner = $fileName;

            Storage::disk('local')->put('public/pages'.'/'.$fileName, $img, 'public');
        }

        if (request()->hasFile('image')) {
            $image      = $request->file('image');
            $fileName   = time() .$image->getClientOriginalName();
            $img = Image::make($image->getRealPath());
            $img->resize(552, 552);
            $img->stream();
            $page->image = $fileName;

            Storage::disk('local')->put('public/pages'.'/'.$fileName, $img, 'public');
        }
        $page->save();
        app('App\Http\Controllers\Activitiescontroller')->store(auth()->user()->id,'Update','Page',$page->id);
        Session()->flash('success' , 'Page Updated Successfully');
        switch($request->submitbutton)
        {
            case 'save':
                return redirect()->back();
                break;
            case 'save-draft':
                return redirect()->route('pages.index');
                break;
        }
    }

    public function destroy($id)
    {
        $page = Page::find($id);
        Storage::disk('public')->delete('pages/'.$page->banner);
        Storage::disk('public')->delete('pages/'.$page->image);
        $page->delete();
        app('App\Http\Controllers\Activitiescontroller')->store(auth()->user()->id,'Deleted','Page',$page->id);
        session()->flash('success' , 'Page Deleted Successfully');
        return redirect()->back();
    }

    public function uploadImage(Request $request)
    {

        if($request->has('upload'))
        {
           $url = $request->file('upload')->store('images','public');
        }
        $url = 'storage/'.$url ;
        $CKEditorFuncNum = $request->CKEditorFuncNum;
        \App\Image::create(['url'=>$url]);
        $message = '';
        $url = asset($url);
        echo "<script type='text/javascript'> window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum,'$url','$message'); </script> ";
    }

}

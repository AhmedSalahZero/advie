<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSectionRequest;
use App\Section;
use Illuminate\Http\Request;

class SectionsController extends Controller
{

    public function index()
    {
//        $test = Section::where("title->en", 'test')->get();
        $sections = Section::paginate(10);
        return view('backend.sections.index' , compact('sections'));
    }
    function fetchDataByAjax(Request $request)
    {

        if ($request->ajax()) {
            $sort_by = $request->get('sortby');
            $sort_type = $request->get('sorttype');
            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);
                  $sections = Section::where("name->en", 'like', '%' . $query . '%')
                      ->orwhere('name->ar', 'like', '%' . $query . '%')
                ->orderBy($sort_by, $sort_type)
                ->paginate(10);
            return view('backend.sections.fetch-Data-By-Ajax', compact('sections'))->render();
        }
    }

    public function create()
    {
        return view('backend.sections.form');
    }


    public function store(StoreSectionRequest $request)
    {
        $data = $request->only(['title','description','page_id','link']);
        $image = $request->image->store('sections','public');
        $data = array_merge($data,['image'=>$image]);
        Section::create($data);
        return redirect()->back()->with('success','section has been inserted');

    }


    public function show($id)
    {
    }

    public function edit(Section $Section)
    {
        return view('backend.sections.form')->with('section',$Section);

    }


    public function update(Request $request, Section $Section)
    {
        if($request->has('image'))
        {
            $this->deleteImageIfExist($Section->image);
            $image = $request->image->store('sections','public');
        }
        else
            $image = $Section->image;
        $Section->update(
            array_merge($request->only(['page_id','title','description','link']) , ['image'=>$image])
        );
        return redirect()->back()->with('success','section has been edited');


    }

    public function destroy(Section $Section)
    {
        $this->deleteImageIfExist($Section->image);
        $Section->delete();
        return redirect()->back()->with('success','section has been deleted') ;


    }
    protected function deleteImageIfExist($image)
    {
        if(file_exists('storage/'.$image))
            unlink('storage/'.$image);
    }
}

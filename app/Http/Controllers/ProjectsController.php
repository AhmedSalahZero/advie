<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProjectsController extends Controller
{
    public function index()
    {
        return view('backend.projects.index')->with('projects',Project::paginate(10));
    }


    public function create()
    {


        return view('backend.projects.form');
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->only(['title','description','image','banner']),$this->rules());
        if($validator->fails())
            return redirect()->back()->with('errors',$validator->errors());
        $image = $request->image->store('/projects','public');
        $banner = $request->banner->store('/projects','public');
        $data = array_merge($request->only(['title','description']) , [
            'image'=>$image ,
            'banner'=>$banner
        ]);

        Project::create($data);
        return redirect()->route('projects.index');


    }

    public function show($lang ,  Project $project)
    {

        return view('frontend.projects')->with('project',$project);
    }


    public function edit( Project $Project)
    {
        return view('backend.projects.form')->with('project',$Project);

    }

    public function update(Request $request, Project $Project)
    {
        $validator = Validator::make($request->only(['title','description','image','banner']) , $this->updateRules());
        if($validator->fails())
            return redirect()->back()->with('errors',$validator->errors());
        if($request->has('image'))
        {
            $this->deleteImageIfExist($Project->image);
            $image = $request->image->store('/projects','public');
        }
        else{
            $image =$Project->image ;
        }
        if($request->has('banner'))
        {
            $this->deleteImageIfExist($Project->banner);
            $banner = $request->banner->store('/projects','public');

        }
        else{
            $banner =$Project->banner ;
        }

        $Project->update(array_merge($request->only(['title','description']) , [
            'image'=>$image ,
            'banner'=>$banner
        ]) );

        return redirect()->back();


    }

    function fetchDataByAjax(Request $request)
    {

        if ($request->ajax()) {
            $sort_by = $request->get('sortby');
            $sort_type = $request->get('sorttype');
            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);
            $projects = Project::where("title->en", 'like', '%' . $query . '%')
                ->orwhere('title->ar', 'like', '%' . $query . '%')
                ->orderBy($sort_by, $sort_type)
                ->paginate(10);
            return view('backend.projects.fetch-Data-By-Ajax', compact('projects'))->render();
        }
    }
    public function destroy(Project $Project)
    {
        $this->deleteImageIfExist($Project->banner);
        $this->deleteImageIfExist($Project->image);
        $Project->delete();
        return redirect()->back();

    }

    public function rules()
    {
        return [
            'title*.en'          => 'required|max:255',
            'title*.ar'          => 'required|max:255',
            'description*.en'          => 'required',
            'description*.ar'          => 'required',
            'image'         => 'required|mimes:jpg,jpeg,bmp,png',
            'banner'        => 'required|mimes:jpg,jpeg,bmp,png',
        ];
    }
    public function updateRules()
    {
        return [
            'title*.en'          => 'required|max:255',
            'title*.ar'          => 'required|max:255',
            'description*.en'          => 'required',
            'description*.ar'          => 'required',
            'image'         => 'mimes:jpg,jpeg,bmp,png',
            'banner'        => 'mimes:jpg,jpeg,bmp,png',
        ];
    }
    protected function deleteImageIfExist($image)
    {
        if(file_exists('storage/'.$image))
            unlink('storage/'.$image);
    }

}

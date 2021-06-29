<?php

namespace App\Http\Controllers;

use App\Page;
use App\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ServicesController extends Controller
{
    public function index()
    {

        return view('backend.services.index')->with('services',Service::paginate(10));
    }


    public function create()
    {


        return view('backend.services.form');
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->only(['title','description','image','banner']),$this->rules());
        if($validator->fails())
            return redirect()->back()->with('errors',$validator->errors());
        $image = $request->image->store('/services','public');
        $banner = $request->banner->store('/services','public');
        $data = array_merge($request->only(['title','description']) , [
            'image'=>$image ,
            'banner'=>$banner
        ]);

        Service::create($data);
        return redirect()->back();

    }

    public function show($lang , Service $service)
    {
        return view('frontend.services')->with('service',$service);
    }


    public function edit(Service $Service)
    {
        return view('backend.services.form')->with('service',$Service);

    }

    public function update(Request $request, Service $Service)
    {
        $validator = Validator::make($request->only(['title','description','image','banner']) , $this->updateRules());
        if($validator->fails())
            return redirect()->back()->with('errors',$validator->errors());
        if($request->has('image'))
        {
           $this->deleteImageIfExist($Service->image);
           $image = $request->image->store('/services','public');

        }
        else{
            $image =$Service->image ;
        }
        if($request->has('banner'))
        {
            $this->deleteImageIfExist($Service->banner);
            $banner = $request->banner->store('/services','public');

        }
        else{
            $banner =$Service->banner ;
        }

        $Service->update(array_merge($request->only(['title','description']) , [
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
            $services = Service::where("title->en", 'like', '%' . $query . '%')
                ->orwhere('title->ar', 'like', '%' . $query . '%')
                ->orderBy($sort_by, $sort_type)
                ->paginate(10);
            return view('backend.sections.fetch-Data-By-Ajax', compact('services'))->render();
        }
    }
    public function destroy(Service $Service)
    {
        $this->deleteImageIfExist($Service->banner);
        $this->deleteImageIfExist($Service->image);
        $Service->delete();
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

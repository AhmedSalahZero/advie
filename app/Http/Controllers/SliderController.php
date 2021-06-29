<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSliderRequest;
use App\Http\Requests\UpdateSliderRequest;
use App\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::paginate(10);
        return view('backend.sliders.index' , compact('sliders'));
    }

    function fetchDataByAjax(Request $request)
    {
        if ($request->ajax()) {
            $sort_by = $request->get('sortby');
            $sort_type = $request->get('sorttype');
            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);
            $sliders = DB::table('sliders')
                ->where('name', 'like', '%' . $query . '%')
                ->orderBy($sort_by, $sort_type)
                ->paginate(10);
            return view('backend.sliders.fetch-Data-By-Ajax', compact('sliders'))->render();
        }
    }

    public function create()
    {
        return view('backend.sliders.form');
    }

    public function store(StoreSliderRequest $request)
    {

        $slider = new Slider();
        $slider->name = $request->name;
        $slider->content = $request['content'];
        $slider->page_id=$request->page_id;
        $slider->link = $request->link;
        if (request()->hasFile('image')) {
            $image = $request->file('image');
            $fileName = time() . '.' . $image->getClientOriginalExtension();
            $img = Image::make($image->getRealPath());
            $img->resize(1920, 900);
            $img->stream();
            $slider->image = $fileName;
            Storage::disk('local')->put('public/sliders' . '/' . $fileName, $img, 'public');
        }
        $slider->save();
        app('App\Http\Controllers\Activitiescontroller')->store(auth()->user()->id,'Create','Slider',$slider->id);
        Session()->flash('success' , 'Slider Created Successfully');
        switch($request->submitbutton)
        {
            case 'save':
                return redirect()->back();
                break;
            case 'save-draft':
                return redirect()->route('sliders.index');
                break;
        }
    }

    public function edit($id)
    {
        $slider = Slider::findOrFail($id);
        return view('backend.sliders.form' , compact('slider'));
    }

    public function update(UpdateSliderRequest $request, $id)
    {
        $slider = Slider::findOrFail($id);
        $slider->name = $request->name;
        $slider->page_id=$request->page_id;
        $slider->content = $request['content'];
        $slider->link = $request->link;
        if ($request->image !== null) {
            Storage::disk('public')->delete('sliders/'.$slider->image);
        }
        if (request()->hasFile('image')) {
            $image      = $request->file('image');
            $fileName   = time() . '.' . $image->getClientOriginalExtension();
            $img = Image::make($image->getRealPath());
            $img->resize(1920, 800);
            $img->stream();
            $slider->image = $fileName;
            Storage::disk('local')->put('public/sliders'.'/'.$fileName, $img, 'public');
        }
        $slider->save();
        app('App\Http\Controllers\Activitiescontroller')->store(auth()->user()->id,'Update','Slider',$slider->id);
        Session()->flash('success' , 'Slider Updated Successfully');
        switch($request->submitbutton)
        {
            case 'save':
                return redirect()->back();
                break;
            case 'save-draft':
                return redirect()->route('sliders.index');
                break;
        }
    }

    public function destroy($id)
    {
        $slider = Slider::findorFail($id);
        Storage::disk('public')->delete('sliders/'.$slider->image);
        $slider->delete();
        app('App\Http\Controllers\Activitiescontroller')->store(auth()->user()->id,'Deleted','Slider',$slider->id);
        session()->flash('success' , 'Slider Deleted Successfully');
        return redirect()->back();
    }
}

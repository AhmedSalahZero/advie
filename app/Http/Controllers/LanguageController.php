<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLanguageRequest;
use App\Http\Requests\UpdateLanguageRequest;
use App\Language;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class LanguageController extends Controller
{
    public function lang($lang)
    {
        if (request()->segment(1) == 'en') {
            return $lang = 'en';
        } elseif (request()->segment(1) !== 'ar' || request()->segment(1) !== 'en') {
            return view('errors.404');
        }
    }


    public function index()
    {
        $languages = Language::paginate(5);
        return view('backend.languages.index' , compact('languages'));
    }


    public function create()
    {
        return view('backend.languages.form');
    }


    public function store(StoreLanguageRequest $request)
    {
        $language = new Language();
        $language->name = $request->name;
        $language->code = $request->code;
        $language->active = $request->active;
        if (request()->hasFile('image')) {
            $image = $request->file('image');
            $fileName = time() . '.' . $image->getClientOriginalExtension();
            $img = Image::make($image->getRealPath());
            $img->resize(1024, 539);
            $img->stream();
            $language->image = $fileName;
            Storage::disk('local')->put('public/languages' . '/' . $fileName, $img, 'public');
        }
        $language->save();
        app('App\Http\Controllers\Activitiescontroller')->store(auth()->user()->id,'Create','Language',$language->id);
        Session()->flash('success' , 'Language Created Successfully');
        switch($request->submitbutton)
        {
            case 'save':
                return redirect()->back();
                break;
            case 'save-draft':
                return redirect()->route('languages.index');
                break;
        }
    }


    public function edit($id)
    {
        $language = Language::findOrFail($id);
        return view('backend.languages.form' , compact('language'));
    }


    public function update(UpdateLanguageRequest $request ,  $id)
    {
        $language = Language::findOrFail($id);
        $language->name = $request->name;
        $language->code = $request->code;
        $language->active = $request->active;
        if ($request->image !== null) {
            Storage::disk('public')->delete('languages/'.$language->image);
        }
        if (request()->hasFile('image')) {
            $image = $request->file('image');
            $fileName = time() . '.' . $image->getClientOriginalExtension();
            $img = Image::make($image->getRealPath());
            $img->resize(1024, 539);
            $img->stream();
            $language->image = $fileName;
            Storage::disk('local')->put('public/languages' . '/' . $fileName, $img, 'public');
        }
        $language->save();
        app('App\Http\Controllers\Activitiescontroller')->store(auth()->user()->id,'Update','Language',$language->id);
        Session()->flash('success' , 'Language Updated Successfully');
        switch($request->submitbutton)
        {
            case 'save':
                return redirect()->back();
                break;
            case 'save-draft':
                return redirect()->route('languages.index');
                break;
        }
    }

    public function destroy($id)
    {
        $language = Language::findOrFail($id);
        Storage::disk('public')->delete('languages/'.$language->image);
        $language->delete();
        app('App\Http\Controllers\Activitiescontroller')->store(auth()->user()->id,'Deleted','Language',$language->id);
        session()->flash('success' , 'Language Deleted Successfully');
        return redirect()->back();
    }
}
